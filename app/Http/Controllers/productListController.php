<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Variant;
use App\Models\ProductDescription;
use App\Models\ProductDetail;

class productListController extends Controller
{
    public function index()
    {
        // Existing method remains the same
        $products = Product::all();
        return view('product-list', ['products' => $products]);
    }

    public function updateProduct(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'status' => 'required|string'
        ]);
    
        $isActive = ($validatedData['status'] === 'Tersedia') ? 1 : 0;
    
        try {
            DB::statement('CALL EditProduct(?, ?, ?, ?)', [
                $validatedData['id'],
                $validatedData['nama'],
                $validatedData['stok'],
                $isActive
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diupdate!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate produk!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function indexAddProduct(Request $request)
    {
       $brands = Brand::all();
       $sizes = Size::all();
       $variants = Variant::all();

       return view('owner.add-product', compact('brands', 'sizes', 'variants'));
    }    

    public function store(Request $request)
    {
      
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_sell_price' => 'required|numeric',
            'warning_stock' => 'required|integer',
            'variant_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'size_id' => 'required|integer',
            'product_description' => 'required|string',
        ]);
        
        try {
            DB::statement('CALL InsertProduct(?, ?, ?, ?, ?, ?, ?)', [
                $request->product_name,
                $request->product_sell_price,
                $request->warning_stock,
                $request->variant_id,
                $request->brand_id,
                $request->size_id,
                $request->product_description,
            ]);

            return redirect()->route('product-list')->with('success', 'Product inserted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error while calling stored procedure: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::with('productDetail')->findOrFail($id);
        $brands = Brand::all();
        $sizes = Size::all();
        $variants = Variant::all();
        return view('owner.owner-detail-product', compact('product', 'brands', 'sizes', 'variants'));
    }

    public function update(Request $request, $id)
    {
        try {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'size_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'warning_stock' => 'required|integer|min:1',
            'product_sell_price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);
        DB::statement('CALL UpdateProduct(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $validatedData['product_name'],
            $validatedData['product_description'],
            $validatedData['size_id'],
            $validatedData['brand_id'],
            $validatedData['variant_id'],
            $validatedData['warning_stock'],
            $validatedData['product_sell_price'],
            $validatedData['stock']
        ]);

        return redirect()->route('product-list')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error while calling stored procedure: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Toggle status produk (1 menjadi 0, dan sebaliknya)
        $product->is_active = !$product->is_active;

        // Simpan perubahan
        $product->save();

        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('product-list')->with('success', 'Product status updated successfully!');
    }

}