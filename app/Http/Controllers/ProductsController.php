<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $products = Product::with(['productDetail']);
        $variants = Variant::all();
        // Pencarian
        if ($request->has('search') && $request->search) {
            $products->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->has('category') && $request->category) {
            $products->whereHas('productDescription', function ($query) use ($request) {
                $query->where('variant_id', $request->category);
            });
        }   

        // Filter harga
        if ($request->has('price_min') && $request->price_min) {
            $products->whereHas('productDetail', function ($query) use ($request) {
                $query->where('product_sell_price', '>=', $request->price_min);
            });
        }
        if ($request->has('price_max') && $request->price_max) {
            $products->whereHas('productDetail', function ($query) use ($request) {
                $query->where('product_sell_price', '<=', $request->price_max);
            });
        }

        // Sorting
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'popular':
                    $products->orderBy('popularity', 'desc'); // Tambahkan kolom popularity jika ada
                    break;
                case 'name_asc':
                    $products->orderBy('product_name', 'asc');
                    break;
                case 'name_desc':
                    $products->orderBy('product_name', 'desc');
                    break;
                case 'price_low_high':
                    $products->orderBy('productDetail.product_sell_price', 'asc');
                    break;
                case 'price_high_low':
                    $products->orderBy('productDetail.product_sell_price', 'desc');
                    break;
                default:
                    $products->orderBy('created_at', 'desc');
            }
        }

        // Ambil data
        $products = $products->get();

        // Kelompokkan produk berdasarkan varian
        $groupedByVariant = $products->groupBy(function ($product) {
            return $product->productDetail->product_variant;
        });

        // Kirim ke view
        return view('products', compact('groupedByVariant', 'variants'));
    }
}
