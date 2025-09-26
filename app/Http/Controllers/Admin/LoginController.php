<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Admin;
use Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3; 
    protected $decayMinutes = 5;

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {   
     
        $this->validate($request,
        [
            'email'=>'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],
        [
            'email.required'=>'Email is required',
            'password.required'=>'Password is required',
            'captcha.captcha'=>'Invalid captcha code.'
        ]);

        $data = [
                'email' => $request->input("email"),
                'password' => $request->input('password')
        ];

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);
            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        if(Auth::guard('admin')->attempt($data)){
            if(Auth::guard('admin')->check()){

                //last login
                $admin_data = Admin::where('email',$data['email'])->first();
                $admin_data->update([
                    'last_login_at' => Carbon::now(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                return redirect('admin/dashboard')->with('success', 'You are successfully logged in'); 
            }
        }
        else{
            $this->incrementLoginAttempts($request);
            return redirect('admin')->with("error",'These credentials do not match our records.');
        }
    }
}