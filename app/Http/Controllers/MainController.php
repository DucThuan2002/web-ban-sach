<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductCustomerService;

class MainController extends Controller
{
    protected $slideService;
    protected $menuService;
    protected $productCustomerService;

    public function __construct(SliderService $slideService, MenuService $menuService, ProductCustomerService $productCustomerService) 
    {
        $this->slideService = $slideService;
        $this->menuService = $menuService;
        $this->productCustomerService = $productCustomerService;
    }


    public function index() 
    {
        return view('products.list', [
            'title' => 'Shop Bán Sách',
            'sliders' => $this->slideService->show(),
            'menus' => $this->menuService->show(),
            'products' => $this->productCustomerService->show(),
            'trangchu' => 1
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productCustomerService->get($page);
        if($result) {
            $html = view('products.list', ['products' => $result])->render();
            return response() -> json([ 'html' => $html ]);
        }

        return response() -> json([ 'html' => 'null' ]);
    }
}
