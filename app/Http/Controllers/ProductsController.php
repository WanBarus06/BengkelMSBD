<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;



class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with(['productDescription.brand', 'productDetail'])->get();
        
        // Mengelompokkan produk berdasarkan brand_name
        $groupedByBrand = $products->groupBy(function ($product) {
            return $product->productDescription->variant->variant_name;
        });

        // Mengirimkan data produk yang sudah dikelompokkan ke view
        return view('products', compact('groupedByBrand'));
    }
}
