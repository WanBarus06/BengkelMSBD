<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('staff.supplier-index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {$request->validate([
        'supplier_name' => 'required|string|max:255',
        'phone_number' => [
            'required',
            'regex:/^[0-9]{10,15}$/',
        ],
        'address' => 'required|string|max:500',
    ], [
        'phone_number.regex' => 'Nomor telepon harus berupa angka dengan panjang 10-15 digit.',
        'supplier_name.required' => 'Nama supplier wajib diisi.',
        'address.required' => 'Alamat wajib diisi.',
    ]);
    

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Pemasok telah berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->is_active = false;
        $supplier->save();
        return redirect()->route('suppliers.index')->with('success', 'Pemasok akan ditandai tidak aktif.');
    }

        public function activate(Supplier $supplier)
    {
        $supplier->is_active = 1;
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Pemasok akan ditandai aktif kembali.');
    }
}
