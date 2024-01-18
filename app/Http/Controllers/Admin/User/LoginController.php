<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\User\redirect;
use App\Models\Social;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    public function index() {
        return view('admin.users.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(Request $request) 
    {
        $validate=$request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate) && $request->input('remember')) {
            return redirect()->route('admin');
        }

        session()->flash('error', 'Tài khoản hoặc mật khẩu không khớp');
        return back();
        
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateUser($user, 'google');
        
        session()->put('admin_login', $authUser->login->admin_name);
        session()->put('admin_id', $authUser->login->admin_id);

        return redirect()->route('admin');
    }

public function findOrCreateUser($user, $provider)
    {
        $authUser = Social::where('provider_user_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        $loginUser = User::where('email', $user->email)->first();

        if (!$loginUser) {
            $loginUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => '', // You might want to handle password differently
                // 'admin_phone' => '',
                // 'admin_status' => 1,
            ]);
        }

        $socialUser = new Social([
            'provider_user_id' => $user->id,
            'provider' => strtoupper($provider),
        ]);

        $socialUser->login()->associate($loginUser);
        $socialUser->save();

        return $socialUser;
    }

}
