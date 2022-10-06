<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Taikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function login(Request $request)
    {
        $user= Session::get('user');
        if($user){
            return redirect('/home');
        }

        $data = $request;
        $taikhoan = DB::table('taikhoan')->where('username', $data['username'])->where('password', $data['password'])->get()->toArray();
        if (count($taikhoan)) {
            Session::put('user', $taikhoan);
            return redirect('/home');
        } else {
            return view('auth/login');
        }
    }
    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
    public function index()
    {
        $user= Session::get('user');
        if(is_null($user)){
            return view('auth/login');
        }else{
            return redirect('/home');
          
        }
    }
    public function doimatkhau(){
        $error = "" ; 
        return view('doimatkhau')->with(compact('error'));
    }
    public function submitdoimatkhau(Request $request){
     
       $data = $request->all();
       $oldPassword = $data['oldPassword'];
       $newPassword = $data['newPassword'];
       $user= Session::get('user');
       $username=$user[0]->username ; 
       $password = $user[0]->password;

       if($oldPassword!= $password ){
            $error = "Mật khẩu cũ không đúng";
            return view('doimatkhau')->with(compact('error'));
       }else{
    
        $userFind  = Taikhoan::find($user[0]->id);
        $userFind->password =  $newPassword ;
        $userFind->save();
        $error = "Thành công";
        return view('doimatkhau')->with(compact('error'));
       }
    }
}
