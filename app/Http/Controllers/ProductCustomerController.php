<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductCustomerService; 
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;

class ProductCustomerController extends Controller
{
    protected $productCustomerService;

    public function __construct(ProductCustomerService $productCustomerService, MenuService $menuService, SliderService $sliderService) 
    {
        $this->productCustomerService = $productCustomerService;
        $this->menuService = $menuService;
        $this->sliderService = $sliderService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productCustomerService->showProduct($id);
        $productMore = $this->productCustomerService->productMore($product);
        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'menus' => $this->menuService->getParent(),
            'sliders' => $this->sliderService->show(),
            'home' => 0,
            'products' => $this->productCustomerService->productMore($product)

        ]);
    }
}
