<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Product;

class CartComposer
{
    protected $users;

    public function __construct() 
    {
        
    }

    public function compose(View $view)
    {
        $carts = session()->get('carts');
        if (is_null($carts)) {
            $products = [];
        }
        else {
            $productID = array_keys($carts);
            $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
                ->where('active', 1)
                ->whereIn('id', $productID)
                ->get();
        }

        $view->with('products', $products);
    }
}
