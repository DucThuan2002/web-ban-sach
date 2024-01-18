<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Class SliderService
{
    public function create($slider) {
        try {
            Slider::create([
                'name' => $slider->name,
                'url' => $slider->url,
                'thumb' => $slider->thumb,
                'sort_by' => $slider->sort_by,
                'active' => $slider->active,
            ]);
            session()->flash('success', 'Tạo slider thành công');
        } catch(\Exception $error) {
            session()->flash('error', 'Tạo slider không thành công');
            \Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function getAll() {
        try {
            return Slider::orderbyDesc('id')->paginate(10);
        } catch(\Exception $error) {
            return false;
        }
    }

    public function update($request, $slider) {
        try {
            $slider->fill($request->input());
            $slider->save();
            session()->flash('success', 'Cập nhật slider thành công');
            return true;
        } catch(\Exception $error) {
            session()->flash('error', 'Cập nhật slider không thành công');
            \Log::info($error->getMessage());
            return false;
        }
    }

    public function delete($request) {
        try {
            $slide=Slider::where('id', $request->input('id'))->first();
            
            if ($slide) {              
                $thumb = $slide->thumb; // Lấy giá trị của 'thumb' từ request
                $thumb = str_replace('/storage', '', $thumb);
                Storage::delete($thumb); // Xóa tệp tin theo đường dẫn 'thumb'
                Slider::where('id', $request->input('id'))->delete();
            }

        } catch (\Exception $error) {
            return false;
        }
        return true;
    }

    public function show() {
        return $sliders = Slider::where('active', 1)->orderByDesc('id')->take(4)->get();
    
    }
}
 