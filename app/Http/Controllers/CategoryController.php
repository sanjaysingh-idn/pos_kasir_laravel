<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('name', 'asc')->get();
        return response()->json([
            'categories' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation
        $attr = $request->validate([
            'name'     => 'required|string|unique:categories,name',
            'icon'     => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
        ]);

        if ($request->file('icon' !== null)) {
            $category = Category::create([
                'name' => $attr['name'],
                'icon' => $request->file('icon')->store('icon'),
            ]);
        } else {
            $category = Category::create([
                'name' => $attr['name'],
            ]);
        }

        return response()->json([
            'category' => $category,
            'message' => 'Kategori berhasil dibuat',
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response([
                'message' => 'Kategori tidak ditemukan.'
            ], 403);
        }

        if (!empty($category->icon)) {
            Storage::delete($category->icon);
        }

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
