<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index() {
        return view('admin.home', [
            'title' => 'Trang Quản Lý của Admin'
        ]);
    }
}
