<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        //guest:admin
        $this->middleware('guest:admin',['except'=>['logout']]);
    }
    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //validate
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|min:6',
        ]);

        //attempt
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($request->only(['email','remember']))->with('error','Đăng nhập thất bại');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

}
