<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\User;

class ChangeAdminPasswordController extends Controller
{
    public function view_change_password_form()
    {
        return view('auth/change_password');
    }

    public function change_password(ChangePasswordRequest $request){
        $password = $request->password;
        $id = Auth::user()->id;
        if($password === $request->password_confirmation){
            User::change_user_password($password, $id);
            return redirect()
                ->route('main-page')
                ->with('message',__('Password Updated'));
        }

        return redirect()
                ->back()
                ->withErrors(__('Passwords Are Not Equal'));
    }
}
