<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User sudah dibuat
use App\Models\StaffListView;

class StaffController extends Controller
{

public function index()
{
    $users = StaffListView::all(); // Ambil semua data dari VIEW
    return view('staff-list', compact('users'));
}

public function addStaff(Request $request)
{
    // Validasi input dari form
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:6',
        'role' => 'required|in:staff',
    ]);

    // Simpan data ke database
    User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone_number' => $validatedData['phone_number'],
        'address' => $validatedData['address'],
        'password' => bcrypt($validatedData['password']),
        'role' => 'staff', // Pastikan role di-set sebagai 'staff'
    ]);

    return redirect()->route('staff-list')->with('success', 'Staff berhasil ditambahkan!');
}

public function toggleStatus($id)
{
    $user = User::findOrFail($id);

    // Pastikan user adalah staf
    if ($user->role !== 'staff') {
        return redirect()->route('staff-list')->with('error', 'Aksi hanya dapat dilakukan untuk Pegawai.');
    }

    // Toggle status aktif
    $user->is_active = !$user->is_active;
    $user->save();

    return redirect()->route('staff-list')->with('success', 'Status berhasil diubah!');
}
 
public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Email harus unik kecuali untuk user ini
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Cari data pegawai berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pegawai
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('staff-list')->with('success', 'Data pegawai berhasil diperbarui.');
    }

}
