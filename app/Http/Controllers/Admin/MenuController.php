<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateMenuRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;
    
    public function __construct(MenuService $menuService = null) 
    {
        $this->menuService = $menuService;
    }
    public function create() 
    {
        return view('admin.menu.add', [
            'title' => 'Thêm Danh Mục Mới',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateMenuRequest $request) 
    {
        $result = $this->menuService->create($request);
        return redirect()->back();
    }
    public function index() 
    {
        return view("admin.menu.list", [
            "title" => "Danh Sách Các Menu",
            "menus" => $this->menuService->getAll()
        ]);
    }
    public function show(Menu $menu) 
    {
        return  view("admin.menu.edit", [
            'title' => 'Thông tin chi tiết '.$menu->name,
            'menu' => $menu,
            'menus' =>$this->menuService->getParent()
        ]);
    }
    public function update( Menu $menu, CreateMenuRequest $request) 
    {
        $this->menuService->update($menu, $request);
        return redirect('/admin/menus/list');
    }
    public function destroy(Request $request) 
    {
       $flag=$this->menuService->delete($request);   
  
        if ( $flag ) {
            return response()->json([
                'error' => 'false',
                'message' => 'Xóa thành công!'
            ]);
        }

        return response()->json([
            'error' => 'true',
            'message' => 'Xóa không thành công!'
        ]);    
    }
}
