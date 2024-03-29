<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
   public function dashboard (){
    return view('admin.dashboard');
   }

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
