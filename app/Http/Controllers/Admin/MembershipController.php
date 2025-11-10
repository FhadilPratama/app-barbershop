<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('admin.membership.index', compact('memberships'));
    }

    public function create()
    {
        return view('admin.membership.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 1️⃣ Buat akun user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'membership', // opsional, kalau kamu punya kolom role
        ]);

        // 2️⃣ Buat data membership yang terkait ke user
        Membership::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.membership.index')
            ->with('success', 'Membership berhasil dibuat dan akun login telah ditambahkan!');
    }

    public function edit(Membership $membership)
    {
        return view('admin.membership.edit', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $membership->update($request->only('name', 'type', 'promo', 'description'));

        return redirect()->route('admin.membership.index')->with('success', 'Membership berhasil diupdate!');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.membership.index')->with('success', 'Membership berhasil dihapus!');
    }
}
