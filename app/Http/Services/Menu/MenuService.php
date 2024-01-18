<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Class MenuService
{
    public function create($request) {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'decription' => (string) $request->input('decription'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
        session()->flash('success','Tạo danh mục thành công');
        } catch(\Exception $err) {
            session()->flash('error','Tạo danh mục không thành công');
            return false;
        }
        return true;
    }
    public function getParent($id=1) {
        return Menu::where('parent_id',0)->get();
    }
    public function getAll() {
        return Menu::orderbyDesc('id')->paginate(20);
    }
    public function update( $menu,  $request) {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = $request->input('parent_id');
        }
        $menu->name = $request->input('name');
        $menu->decription = $request->input('decription');
        $menu->content = $request->input('content');
        $menu->active = $request->input('active');
        $menu->slug = Str::slug($request->input('name'), '-');
        $menu->save(); 
    
        session()->flash('success', 'Cập nhật thành công');
        return true;
    }
    public function delete($request) {
        $id = $request->input('id');
        $menu=Menu::where('id', $id);
       
        if ($menu) {
            Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
            return true;
        }
        return false;
    }

    public function show()
    {
        return Menu::where('active',1)->where('parent_id', 0)->orderByDesc('id')->take(4)->get();
   
    }

    public function getID($id = null)
    {
        return Menu::where('active', 1)->where('id', $id)->firstorFail();
    }

    public function getProducts($menu, $request)
    {
        $query = $menu->products()->select('id', 'name', 'price', 'price_sale', 'thumb')
                                ->where('active', 1);
        if($request->input('price')) {
            $query->orderBy('price_sale', $request->input('price'));
        }
        else {
            $query->orderByDesc('id');
        }
                                
        return $query->paginate(12)->withQueryString();;
    }
    
}
 