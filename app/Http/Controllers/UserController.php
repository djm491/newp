<?php

namespace App\Http\Controllers;

use App\RegisteredUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function getLoginForm() {
        return view('auth.login');
    }
    public function Login(Request $request)
    {

        if (!request()->has('username')) {
            return redirect()->back()->withErrors(['Please include a username']);
        }
        if (!request()->has('password')) {
            return redirect()->back()->withErrors(['Please enter a valid password.']);
        }

        $user = RegisteredUser::where('reg_users.username', '=', request('username'))
                              ->first();
        if (!$user) {
            return redirect()->back()->withErrors(['You\'re not an authorized user. Please sgin up first!']);
        }

        if (Auth::attempt(['email' => $user->email, 'password' => request('password')])) {
            $this->_updateUserSession([
                'platform' => 'newp',
                'user_id' => $user->id,
                'email' => $user->email,
                'username' => $user->username,
            ]);

            return redirect()->intended('/home');
        }
        return redirect()->back()->withErrors(['Invalid Password']);

    }
    private function _updateUserSession( $data=[] ) {
        session( $data );
    }
}
