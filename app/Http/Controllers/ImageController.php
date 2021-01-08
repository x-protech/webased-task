<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Log::info($request->all());
        dd($request->image);
    }

    public function image()
    {
        return view('image');

    }
}
