<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string|max:2000',
    ]);

    // contoh: simpan ke DB, atau kirim email
    // Mail::to('halo@sanjaiku.id')->send(new ContactMessage($validated));

    return back()->with('success', 'Pesan Anda berhasil terkirim!');
}
}
