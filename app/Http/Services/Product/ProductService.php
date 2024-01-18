<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Menu;

Class ProductService
{
    public function getMenu() {
        return Menu::where('active', 1)->get();
    }

    public function isValidatePrice($request) {
        if ($request->input('price') > $request->input('price_sale')) {
            session()->flash('error', 'Giá bán phải lớn hơn giá gốc');
            return false;
        }
        return true;
    }

    public function create($request) {
        $flag = $this->isValidatePrice($request);
        if ($flag == false) {
            return false;
        }
        try {
            Product::create([
                'name' => (string) $request->input('name'),
                'decription' => (string) $request->input('decription'),
                'content' => (string) $request->input('content'),
                'menu_id' => (string) $request->input('menu_id'),
                'price' => (string) $request->input('price'),
                'price_sale' => (string) $request->input('price_sale'),
                'active' => (string) $request->input('active'),
                'thumb' => (string) $request->input('thumb'),
            ]);
        session()->flash('success','Tạo sản phẩm thành công');
        } catch(\Exception $err) {
            session()->flash('error','Tạo sản phẩm không thành công');
            return false;
        }
        return true;
    }

    public function getAll() {
        return Product::with('menu')->
        orderbyDesc('id')->paginate(10);
    }

    public function update($request, $product) {
        $flag=$this->isValidatePrice($request);
        if ($flag == false) {
            return false;
        } 

        try {
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Cập nhật sản phẩm thành công');
        }catch(\Exception $error) {
            session()->flash('error', 'Cập nhật sản phẩm không thành công');
            \Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request) {
        $id = $request->input('id');
        $menu=Product::where('id', $id);
        
        if ($menu) {
            Product::where('id', $id)->delete();
            return true;
        }
        return false;
    }
}

 