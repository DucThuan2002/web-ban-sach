@extends('admin.main')

@section('content')
<table style="margin-top: 10px">
    @include('admin.alert')
    <thead>
        <th style="width: 50px">ID</th>
        
        <th>Tên Sản Phẩm</th>
        <th>Danh Mục</th>
        <th>Giá Gốc</th>
        <th>Giá Khuyến Mãi</th>
        <th>Active</th>
        <th>Update</th>
        <th style="width: 100px">&nbsp</th>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr style="margin-top: 10px;">
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->menu->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->price_sale }}</td>
            <td>{!! App\Helpers\Helper::active($product->active) !!}</td>
            <td>{{ $product->updated_at }}</td>
            <td>
                <a href="/shop/admin/products/edit/{{ $product->id }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $product->id }}, '/shop/admin/products/destroy')">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

{!! $products->links() !!}

@endsection