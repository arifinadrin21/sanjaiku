<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // <-- tambahan

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return view('admin.profile.edit', compact('user'));
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // maks 2MB
            'old_password' => 'nullable|required_with:password',      // wajib jika password diisi
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika ada password baru
        if ($request->filled('password')) {
            // Cek kecocokan password lama
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
            }

            $user->password = Hash::make($request->password);
        }

        // Jika ada upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru
            $user->photo = $request->file('photo')->store('profiles', 'public');
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}