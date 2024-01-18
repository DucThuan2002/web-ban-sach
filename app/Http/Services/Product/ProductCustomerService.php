<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Class ProductCustomerService
{
    const LIMIT = 16;

    public function show() {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'decription')
                ->where('active', 1)
                ->orderByDesc('id')
                ->limit(self::LIMIT)
                ->get();
    }

    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'decription')
                ->where('active', 1)
                ->orderByDesc('id')
                ->when($page != null, function($query) use ($page) {
                    $query->offset($page * self::LIMIT);
                })
                ->limit(self::LIMIT)
                ->get();
    } 

    public function showProduct($id)
    {
        return  Product::where('id', $id)->where('active', 1)->with('menu')->FirstOrFail();
    }

    public function productMore($product)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'decription')
            ->where('active', 1)
            ->where('id', '<>', $product->id)
            ->orderByDesc('id')
            ->limit(4)
            ->get();

    }
}
