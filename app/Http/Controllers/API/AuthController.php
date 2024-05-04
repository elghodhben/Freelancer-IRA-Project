<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function index(Request $request)
    {
        return $request->user();
    }


    public function login(Request $request)
    {

        $c = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'

        ]);

        if (Auth::attempt($c)) {
            $user = Auth::user();

            //check status of users
            $status = User::where('email', $user->email)->where('status', 1)->count();

            if ($status > 0) {
                // Status is active (status = 1)
                $token = md5(time()) . '.' . md5($request->email);
                $user->forceFill([
                    'api_token' => $token,
                ])->save();
                return response()->json([
                    'token' => $token,
                ], 200);
            } else {
                // Status is inactive or does not exist (status != 1)
                return response()->json(['message' => 'Admin did not activate your account'], 403);
            }
        }
        return response()->json([
            'message' => "Invalid credentials. Please check your email and password and try again."
        ], 401);
    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {

        $validator = Validator::make(request()->all(), [

            'cin' => 'required|unique:users',
            'email' => 'required|email|unique:users',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = request()->name;
        $user->cin = request()->cin;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->save();

        return response()->json($user, 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function sendPasswordResetToken(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        Log::info('Request email: ' . $request->email);

        // Check if the email exists in the 'users' table
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['message' => 'User email not found. Please verify the email address and try again.'], 404);
        }

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(1000, 9999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        return response(['message' => trans('passwords.sent')], 200);
    }

    public function CodeCheckController(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);


        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // Check if the reset code does not exist
        if (!$passwordReset) {
            return response()->json(['message' => 'Reset code not found or has expired'], 404);
        }

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
            'code' => $passwordReset->code,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    }

    public function setNewAccountPassword(Request $request)
    {
        $request->validate([
            'code' => 'exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }

        // Attempt to update user's password
        try {

            $user->password = Hash::make($request->password);
            $user->save();
        } catch (\Exception $e) {
            // Log error
            Log::error('Error updating user password: ' . $e->getMessage());
            return response(['message' => 'Error updating password. Please try again.'], 500);
        }


        // delete current code
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
}
