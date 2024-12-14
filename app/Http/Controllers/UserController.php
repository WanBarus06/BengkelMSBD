<?php

namespace App\Http\Controllers;

use App\Models\User; // Mengimpor model User
use Illuminate\Http\Request;
use App\Models\UserListView;

class UserController extends Controller
{
    public function index()
    {
        $users = UserListView::all(); // Ambil semua data dari VIEW
        return view('user-list', compact('users'));
    }

    // Toggle status pengguna
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active; // Mengubah status aktif/tidak aktif
        $user->save();

        return redirect()->route('user-list')->with('success', 'Status pengguna telah diperbarui.');
    }
}