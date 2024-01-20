<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService = null) {
        $this->userService = $userService;
    }

    public function index()
    {
        $admins = $this->userService->getUserRoles();

        return view('admin.users.all_users', [
            'title' => 'Danh sách cách User',
            'admins' => $admins
        ]);

    }

    public function assign_roles(Request $request)
    {
        $data = $request->all();
        $this->userService->assgin_roles($data);

        return back();
    }
    
}
