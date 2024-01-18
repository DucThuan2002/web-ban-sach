<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use App\Models\Customer;
use App\Models\Cart;

class CartAdminController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService, ) 
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('admin.carts.customer', [
            'title' => 'Danh sách đơn hàng',
            'customers' => $this->cartService->getCustomer()
        ]);
    }

    public function show(Customer $customer)
    {
        $carts = $this->cartService->getProductForCart($customer);
        return view('admin.carts.detail', [
            'title' => 'Chi Tiết Đơn Hàng '. $customer->name,
            'customer' => $customer,
            'carts' => $carts
        ]);
    }
}
