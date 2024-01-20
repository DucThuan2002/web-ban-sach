<?php

namespace App\Http\Services\User;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

Class UserService
{
    public function create($request)
    {
       
        $data = $request->all();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            return true;
            session()->flash('success', 'Tạo thành công user');
        }

        session()->flash('error', 'Tạo user không thành công');
        return false;
    }

    public function getUserRoles()
    {
        return User::with('roles')->orderByDesc('id')->paginate(5);
    }

    public function assgin_roles($request)
    {
        // try {
            $user = User::where('email', $request['email'])->first();
            $user->roles()->detach();

            if ($request['admin_role']) {
                $user->roles()->attach(Roles::where('name', 'admin')->first());
            }
            if ($request['author_role']) {
                $user->roles()->attach(Roles::where('name', 'author')->first());
            }
            if ($request['user_role']) {
                $user->roles()->attach(Roles::where('name', 'user')->first());
            }
            session()->flash('success', 'Cấp quyền thành công');
            return true;
        // } catch (\Throwable $th) {
        //     dd($th);
        //     session()->flash('error', 'Cấp quyền không thành công');
        //     return false;
        // }
        // return false;
        
    }

    
}