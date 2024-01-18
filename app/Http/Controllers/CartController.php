<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use Illuminate\Support\Facades\Redirect;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService, MenuService $menuService, SliderService $sliderService) 
    {
        $this->menuService = $menuService;
        $this->sliderService = $sliderService;
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request->input('num_product'), $request->input('product_id'));

        if ($result != true) {
            return back();
        }

        return \redirect('carts');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'menus' => $this->menuService->getParent(),
            'sliders' => $this->sliderService->show(),
            'products' => $products,
            'carts' => session()->get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);
        return \redirect('/carts');
    }

    public function remove($id = 0)
    {
        $result = $this->cartService->delete($id);
        return \redirect('/carts');
    }

    public function addCart(Request $request)
    {
        switch ($request->input('payment_method')) {
            case 'cash':
                $this->cartService->addCart($request);
                return back();
                break;
            
            default:
                
                $this->cartService->momoPayment($request);
                break;
        } 
    }
}
