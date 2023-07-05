<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response([
            'products' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation
        $attr = $request->validate([
            'name'          => 'required|string|unique:products,name',
            'category'      => 'required|numeric',
            'desc'          => 'required|string',
            'image'         => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'priceBuy'      => 'required|numeric',
            'priceSell'     => 'required|numeric',
            'stock'         => 'required|numeric',
            'barcode'       => 'required|string',
        ]);

        $productData = [
            'name'      => $attr['name'],
            'category'  => $attr['category'],
            'desc'      => $attr['desc'],
            'priceBuy'  => $attr['priceBuy'],
            'priceSell' => $attr['priceSell'],
            'stock'     => $attr['stock'],
            'barcode'   => $attr['barcode'],
        ];

        if ($request->hasFile('image')) {
            $productData['image'] = $request->file('image')->store('image');
        }

        $product = Product::create($productData);

        return response()->json([
            'product' => $product,
            'message' => 'Produk berhasil diupload',
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response([
                'message' => 'Kategori tidak ditemukan.'
            ], 403);
        }

        if (!empty($product->icon)) {
            Storage::delete($product->icon);
        }

        $product->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
