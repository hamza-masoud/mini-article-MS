<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'email or password incorrect',
            ]);
        } else {
            if (!\Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'email' => 'email or password incorrect',
                ]);
            }
        }
        \Auth::login(User::find(1), $request->remember_me);

        return redirect()->route('home');
    }


    public function register(Request $request)
    {
        $user = User::create($request->all());
        \Auth::login($user, $request->remember_me);

        return to_route('articles.index');
    }


    public function logout(Request $request)
    {
        \Auth::logout();

        return to_route('auth.login');
    }
}
