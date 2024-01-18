@extends('admin.main')

@section('content')
<table style="margin-top: 10px">
    @include('admin.alert')
    <thead>
        <th style="width: 50px">ID</th>
        <th>Name</th>
        <th>Active</th>
        <th>Update</th>
        <th style="width: 100px">&nbsp</th>
    </thead>
    <tbody>
        {!! \App\Helpers\Helper::menu($menus) !!}
    </tbody>
</table>

{!! $menus->links() !!}

@endsection