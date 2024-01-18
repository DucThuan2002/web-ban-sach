<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

Class UploadService
{
    public function store ($request) {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $uploadDate = date('Y/m/d');
            $pathFull = 'uploads/'. $uploadDate;           
            $file->storeAs(
                'public/' . $pathFull, $name 
            );
            return '/public/storage/'. $pathFull. '/' . $name;
        }
        return  false;
    }
    
}
 