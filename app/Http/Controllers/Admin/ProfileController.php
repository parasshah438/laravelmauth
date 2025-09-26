<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\Admin;
use Image;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {        
        return view('admin.profile');
    }

    public function update_profile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|unique:admins,email,'.Auth::guard('admin')->user()->id,
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|numeric|min:10|unique:admins,mobile,'.Auth::guard('admin')->user()->id,
            'captcha' => 'required|captcha',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ],[
            'name.required' => 'Username is required.',
            'email.required' => 'Email is required.',
            'mobile.required' => 'Mobile number is required.',
            'captcha.captcha'=>'Invalid captcha code.'
        ]);

    $id = Auth::guard('admin')->user()->id;
        $data = Admin::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->mobile = $request->input('mobile');
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly).'-'. rand() .'_'.time().'.'.$extension;
            $destinationPath = public_path('/admin_assets/admin_profile');
            $image->move($destinationPath,$compPic); 
            $data->image = $compPic;
        }
        $data->save();
        return redirect()->back()->with('success','Profile updated successfully');
    }

    public function change_password()
    {        
        return view('admin.change_password');
    }

    public function update_change_password(Request $request)
    {

        $this->validate($request,[
                'current_password' => 'required',
                'new_password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,50}/',    
                'new_confirm_password' => 'required|same:new_password',
                'captcha' => 'required|captcha'
        ],[
                'current_password.required' => 'Current password is required.',
                'new_password.required' => 'New password is required.',
                'new_password.regex' => 'Password (UpperCase, LowerCase, Number, SpecialChar and min 8 Chars)',
                'new_confirm_password.required' => 'Confirm password is required.',
                'new_confirm_password.same' => 'New password and confirm password must be same.',
                'captcha.captcha'=>'Invalid captcha code.'
        ]);

    $hashedPassword = Auth::guard('admin')->user()->password; 
    $id = Auth::guard('admin')->user()->id;
        $data = Admin::find($id);
        if(Hash::check($request->current_password,$hashedPassword)) {

            if($password = $request->input('new_password')) {
                if(Hash::check($request->get('new_password'), Auth::guard('admin')->user()->password)) {
                    return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password");
                }
                else
                {
                    $data->password = Hash::make($request->input('new_password'));
                }
            } 
        }else{
            return redirect()->back()
            ->with('error','old password doesnt matched.');
        }    
        $data->save();
        return redirect()->back()
        ->with('success','Profile updated successfully');
    }
}