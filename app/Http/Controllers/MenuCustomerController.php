<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;

class MenuCustomerController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService, SliderService $sliderService) {
        $this->menuService = $menuService;
        $this->sliderService = $sliderService;
    }

    public function index(Request $request, $id, $slug = null)
    {
        $menu = $this->menuService->getID($id);
        $products = $this->menuService->getProducts($menu, $request);

        return view('menu',[
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu,
            'menus' => $this->menuService->getParent(),
            'sliders' => $this->sliderService->show(),
            'home' => 0
        ]);

    }
}
