<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    public function login()
    {
        
        return back()->withInput();
    }
    
    public function check(Request $request)
    {
        //Validate requests
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userInfo = Users::where('email','=',$request->email)->first();
        if(!$userInfo){
            return back()->with('fail','Chúng tôi không nhận ra địa chỉ email này');
        } else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put(['LoggedUser' => $userInfo->id, 'RoleUser' => $userInfo->role]);
                $type = strlen($userInfo->role)>4?"admin":"user";
                return redirect("$type/home");
            } else{
                return back()->with('fail', 'Sai mật khẩu, vui lòng kiểm tra lại');
            }
        }
    }

    public function home()          
    {
        return strlen(session()->get('RoleUser'))>4?redirect("admin/home"):redirect("user/home");
    }

    public function logout()
    {
    }
    public function gitpull()
    {
        shell_exec("cd C:\\xampp\htdocs\qlgd");
        shell_exec("git pull");
        return view('home');
    }
}
