<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();  // Ambil semua user
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form untuk menambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi input user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        // Tentukan status membership
        // Jika role user = 'user', maka membership_status = 'normal'
        $membershipStatus = $request->role == 'user' ? 'normal' : $request->membership_status;

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'membership_status' => $membershipStatus,
        ]);

        return redirect()->route('admin.users.index');
    }

    // Menampilkan form untuk mengedit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        // Tentukan status membership
        // Jika role user = 'user', maka membership_status = 'normal', jika admin bisa memilih
        $membershipStatus = ($user->role == 'user') ? 'normal' : $request->membership_status;

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'membership_status' => $membershipStatus,
        ]);

        return redirect()->route('admin.users.index');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
