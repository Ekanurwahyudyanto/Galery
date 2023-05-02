<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\support\Facades\Validate;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $images = new Image();
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $filename = "";
        if ($request->hasFile('image')) {
            $md5Name = md5_file($request->file('image')->getRealPath());
            $guessExtension = $request->file('image')->guessExtension();
            $filename = Str::uuid()->toString().".".$guessExtension;
            $fullpath = $request->file('image')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }


        $images->title = $request->title;
        $images->image = "storage/img/".$filename;
        $result = $images->save();
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => $images
            ], 200);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function get()
    {
        $images = Image::orderBy('id', 'DESC')->get();
        return response()->json($images);
    }

    public function edit($id)
    {
        $images = Image::findOrFail($id);
        return response()->json($images);
    }

    public function update(Request $request, $id)
    {
        $images = Image::findOrFail($id);

        $destination = public_path("strong\\" . $images->image);
        $filename = "";
        if ($request->hasFile('new_image')) {
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $filename = $request->file('new_image')->store('img', 'public');
        } else {
            $filename = $request->image;
        }

        $images->title = $request->title;
        $images->image = $filename;
        $result = $images->save();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    public function delete($id)
    {
        $images = Image::findOrFail($id);
        $destination = public_path("storage\\" . $images->image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $result = $images->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
