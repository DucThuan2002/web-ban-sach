@extends('admin.main')

@section('content')
<table style="margin-top: 10px">
    @include('admin.alert')
    <thead>
        <th style="width: 50px">ID</th>
        
        <th>Tên Khách Hàng</th>
        <th>Số Điện Thoại</th>
        <th>Email</th>
        <th>Ngày Đặt Hàng</th>
        <th style="width: 100px">&nbsp</th>
    </thead>
    <tbody>
    @foreach($customers as $key => $customer)
        <tr style="margin-top: 10px;">
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->created_at }}</td>
            <td>
                <a href="/shop/admin/customer/view/{{ $customer->id }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $customer->id }}, '/shop/admin/customer/destroy')">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
<div style="margin-top: 10px;">
    {!! $customers->links() !!}
</div>


@endsection