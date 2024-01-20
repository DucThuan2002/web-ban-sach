@extends('admin.main')

@section('content')
<table style="margin-top: 10px">
    @include('admin.alert')
    <thead>
        <th style="width: 50px">ID</th>    
        <th>Tên user</th>
        <th>Email</th>
        <th>Password</th>
        <th>Author</th>
        <th>Admin</th>
        <th>User</th>
        <th>&nbsp</th>
    </thead>
    <tbody>
    @foreach($admins as $admin)
        <form action="/shop/admin/assign-roles" method="post">
        @csrf
            <tr style="margin-top: 10px;">
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>
                    {{ $admin->email }}
                    <input type="hidden" name="email" value="{{ $admin->email }}">
                </td>
                <td>{{ $admin->password }}</td>

                <td>
                    <input type="checkbox" name="author_role" {{ $admin->hasRole('author') ? 'checked' : ' ' }}>
                </td>
                <td>
                    <input type="checkbox" name="admin_role" {{ $admin->hasRole('admin') ? 'checked' : ' ' }}>
                </td>
                <td>
                    <input type="checkbox" name="user_role" {{ $admin->hasRole('user') ? 'checked' : ' ' }}>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Assgin role</button>
                </td>

                <!-- <td>
                    <a href="/shop/admin/admins/edit/{{ $admin->id }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $admin->id }}, '/shop/admin/admins/destroy')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td> -->

            </tr>
        </form>
        
    @endforeach
    </tbody>
</table>

{!! $admins->links() !!}

@endsection