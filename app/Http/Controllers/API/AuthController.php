<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    public function index(Request $request){
        return $request->user();
    }


  public function login (Request $request){

    $c=$request->validate([
        'email'=>'required',
        'password'=>'required|min:6'

    ]);

    if(Auth::attempt($c)){
        $user=Auth::user();

        //check status of users
        $status = User::where('email', $user->email)->where('status', 1)->count();

        if ($status > 0) {
            // Status is active (status = 1)
            $token=md5(time()).'.'.md5($request->email);
            $user->forceFill([
                'api_token'=>$token,
            ])->save();
            return response()->json([
                'token'=>$token,
            ],200);
        } else {
            // Status is inactive or does not exist (status != 1)
            return response()->json(['message' => 'Admin did not activate your account'], 403);

        }


    }
      return response()->json([
        'message' => "Invalid credentials. Please check your email and password and try again."
    ],401);
  }


       /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register() {

        $validator = Validator::make(request()->all(), [

            'cin' => 'required|unique:users',
            'email' => 'required|email|unique:users',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = request()->name;
        $user->cin = request()->cin;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->save();

      /*   $email= request()->email;
        $messageData=['name'=> request()->name,'email'=>request()->email,
        'code'=>base64_encode(request()->email)];
        Mail::send('emails.confirmation',$messageData,function($message)use($email){
            $message->to($email)->subject('confirm your account ');
        }); */

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



}
