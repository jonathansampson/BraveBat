<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function resendVerificationEmail()
    {
        $user = auth()->user();
        $user->sendEmailVerificationNotification();
        session()->flash('status', 'Verification email has been sent!');
        return back();
    }
}
