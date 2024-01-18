<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService) {
        $this->sliderService = $sliderService;
    }
    public function create(Request $request) {
        return view('admin.slider.add', [
            'title' => 'Thêm slider mới'
        ]);
    }
    public function store(Request $request) {
        $this->sliderService->create($request);
        return redirect()->back();
    }

    public function index() {
        return view('admin.slider.list', [
            'title' => 'Danh sách slider mới nhất',
            'sliders' =>$this->sliderService->getAll()
        ]);
    }

    public function show(Slider $slider) {
        return view('admin.slider.edit', [
            'title' => 'Chi tiết về '.$slider->name,
            'slider' => $slider
        ]);
    }

    public function update(Request $request,Slider $slider) {
        $this->sliderService->update($request, $slider);
        return redirect('/admin/sliders/list');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $flag = $this->sliderService->delete($request);
        if ($flag) {
            return \response()->json([
                'error' =>'false',
                'message' => 'Xóa slider thành công'
            ]);
        }
        
        return \response()->json([
            'error' =>'true',
            'message' => 'Xóa slider không thành công'
        ]);
    }
}
