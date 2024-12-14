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
    public function getProductList()
    {
        // Existing method remains the same
        $products = DB::select('CALL GetProductList()');
        return view('product-list', compact('products'));
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
    
    public function addProduct(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:255',
            'size_name' => 'required|string|max:255',
            'variant_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'product_photo' => 'nullable|string|max:255',
            'stock' => 'required|integer',
            'product_sell_price' => 'required|integer',
        ]);
    
        // Mulai transaksi
        DB::beginTransaction();
    
        try {
            // Insert ke tabel brands jika belum ada
            $brand_id = Brand::firstOrCreate(['brand_name' => $validatedData['brand_name']])->id;
    
            // Insert ke tabel sizes jika belum ada
            $size_id = Size::firstOrCreate(['size_name' => $validatedData['size_name']])->id;
    
            // Insert ke tabel variants jika belum ada
            $variant_id = Variant::firstOrCreate(['variant_name' => $validatedData['variant_name']])->id;
    
            // Insert ke tabel product_descriptions
            $description_id = ProductDescription::create([
                'brand_id' => $brand_id,
                'size_id' => $size_id,
                'variant_id' => $variant_id,
                'product_description' => $validatedData['product_description'],
                'product_photo' => $request->product_photo ?? null,
            ])->id;
    
            // Insert ke tabel products
            $product_id = Product::create([
                'product_name' => $validatedData['product_name'],
                'description_id' => $description_id,
                'is_active' => 1,
            ])->id;
    
            // Insert ke tabel product_details
            ProductDetail::create([
                'product_id' => $product_id,
                'stock' => $validatedData['stock'],
                'product_sell_price' => $validatedData['product_sell_price'],
            ]);
    
            DB::commit(); // Commit transaksi
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika ada error
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan produk: ' . $e->getMessage()]);
        }
    
        return redirect()->route('product-list')->with('success', 'Produk berhasil ditambahkan!');
    }    

}