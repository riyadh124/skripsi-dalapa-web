<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/images', $filename);

        $image = new Image();
        $image->file_path = $filename;
        $image->save();

        $url = asset('storage/images/' . $filename);

        return response()->json([
            'status' => true,
            'url' => $url,
        ]);
    }
}
