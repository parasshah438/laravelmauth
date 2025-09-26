<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm() {
        return view('admin.password.admin-email');
    }

    //defining which password broker to use, in our case its the admins
    protected function broker() {
        return Password::broker('admin');
    }
}