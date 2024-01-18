@extends('admin.main')

@section('content')
<div class="customer mt-3">
    <ul>
        <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
        <li>Số Điện Thoại: <strong>{{ $customer->phone }}</strong></li>
        <li>Địa Chỉ: <strong>{{ $customer->address }}</strong></li>
        <li>Email: <strong>{{ $customer->email }}</strong></li>
        <li>Ghi Chú: <strong>{{ $customer->content }}</strong></li>
    </ul>
</div>

<div class="carts">
    <?php $total = 0;?>
    <table class="table">
            <tr class="table_head">
                <th class="column-1">IMG</th>
                <th class="column-2">Product</th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-5">Total</th>
                <th class="column-6">&nbsp</th>
            </tr>
        @foreach($carts as $key => $cart)
            <?php 
                $priceEnd = $cart->price * $cart->pty;
                $total = $total + $priceEnd;
            ?>
            <tr>
                <td class="column-1">
                    <div class="how-itemcart1">
                        <img src="/shop/{{ $cart->products->thumb }}" alt="IMG" style="width: 100px">
                    </div>
                </td>
                <td class="column-2">{{ $cart->products->name }}</td>
                <td class="column-3">{{ number_format($cart->price) }}VNĐ</td>
                <td class="column-4">{{ $cart->pty }}</td>
                <td class="column-5">{{ number_format($priceEnd) }}VNĐ</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right">Tổng tiền </td>
            <td>{{ number_format($total) }}</td>
        </tr>
    </table>
</div>


@endsection