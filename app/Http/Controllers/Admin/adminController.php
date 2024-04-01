<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
   public function dashboard (){
    return view('admin.dashboard');
   }

   /***********************login fonction*************************************** */
   public function login (Request $request){
    if ($request->isMethod('post')){
        $data = $request->all();
       // echo "<pre>"; print_r($data);die;

        $rules= [
        'email' => 'required|email|max:255',
        'password' => 'required'
          ];

    $messages=[
        'email.required' => 'email address is required',
        'email.email' => 'valid email address is required',
        'password.required' => 'password is required'
    ];

    $this->validate($request,$rules,$messages);
        if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('admin/dashboard');
        } else{
            return redirect ()->back()->with('error_message','Invalid email or password');
         }

    }
    return view('admin.login');
 }

   /***********logout fonction************************************************************************* */
   public function logout (){

    Auth::guard('admin')->logout();
    return redirect('admin/login');

 }
   /************get all users  */
   public function users (){
    $users=User::get()->toarray();
    return view('admin.users.users')->with(compact('users'));
   }


   /************* active or inactive */

    /**********update users status******************* */
    public function UpdateUserStatus  (Request $request){
        if($request->ajax()){
            $data=$request->all();
         if($data['status']=="Active")
           {
         $status=0;
        }else{
         $status=1;
        }

    User::where('id',$data['user_id'])->update(['status'=>$status]);
      return response ()->json(['status'=>$status,'user_id'=>$data['user_id']]);
    }

    }


}
