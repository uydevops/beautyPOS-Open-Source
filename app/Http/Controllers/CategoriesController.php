<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->except('_token');

        if (empty($data['name'])) {
            return redirect()->back()->withErrors(['name' => 'Kategori adı gereklidir.']);
        }
        if ($request->hasFile('image')) {
            $imagePath = $this->handleImageUpload($request);
            if (!$imagePath) {
                return redirect()->back()->withErrors(['image' => 'Geçersiz resim dosyası.']);
            }
            $data['image'] = $imagePath;
        }
        $data['created_at'] = now();
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Kategori başarıyla eklendi');
    }


    private function handleImageUpload(Request $request)
    {
        $image = $request->file('image');
        if ($image->isValid() && in_array($image->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']) && $image->getSize() <= 2048000) {
            return $this->uploadImage($image);
        }
        return null; 
    }

    private function uploadImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/Categories');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);
        return $imageName;
    }
}
