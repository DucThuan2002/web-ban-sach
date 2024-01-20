<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\User\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    public function register_auth()
    {
        return view('admin.custom_auth.register', [
            'title' => 'Đăng ký bằng Autheciation'
        ]);
    }

    public function register(Request $request)
    {
        $this->validation($request);
        $result = $this->userService->create($request);
        
        return redirect('register-auth');


    }

    public function validation($request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:13'
        ]);
        
    }

    
}
