<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Assuming you want to get the authenticated user
        return view('profile.index', compact('user'));
    }


    public function updateAboutMe(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'job_title' => 'required|string|max:255',
            'address' => 'required|string',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'phone_number.required' => 'Kolom nomor telepon wajib diisi.',
            'phone_number.max' => 'Nomor telepon tidak boleh melebihi 20 karakter.',
            'job_title.required' => 'Kolom pekerjaan wajib diisi.',
            'address.required' => 'Kolom alamat wajib diisi.',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'job_title' => $request->input('job_title'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Kolom password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password berhasil diperbarui.');
    }
}
