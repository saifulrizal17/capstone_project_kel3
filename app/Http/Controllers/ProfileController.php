<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\CatatanKeuangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Auth::check() && Auth::user()->role_id == '1') {
            //Admin
            $financialHistory = CatatanKeuangan::orderBy('tanggal_transaksi', 'desc')->get();

            $income = CatatanKeuangan::where('id_jenis', 1)->sum('jumlah');
            $expense = CatatanKeuangan::where('id_jenis', 2)->sum('jumlah');
            $balance = $income - $expense;
        } else {
            // User
            $financialHistory = CatatanKeuangan::where('id_user', $user->id)
                ->orderBy('tanggal_transaksi', 'desc')
                ->get();

            $income = CatatanKeuangan::where('id_user', $user->id)
                ->where('id_jenis', 1)
                ->sum('jumlah');

            $expense = CatatanKeuangan::where('id_user', $user->id)
                ->where('id_jenis', 2)
                ->sum('jumlah');

            $balance = $income - $expense;
        }

        return view('profile.index', compact('user', 'financialHistory', 'balance', 'income', 'expense'));
    }

    public function updateAboutMe(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'job_title' => 'required|string|max:255',
            'address' => 'required|string',
            'profile_photo' => 'nullable|file|max:2048',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'phone_number.required' => 'Kolom nomor telepon wajib diisi.',
            'phone_number.max' => 'Nomor telepon tidak boleh melebihi 20 karakter.',
            'job_title.required' => 'Kolom pekerjaan wajib diisi.',
            'address.required' => 'Kolom alamat wajib diisi.',
            'profile_photo.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        if ($user->profile_photo) {
            $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'job_title' => $request->input('job_title'),
            'address' => $request->input('address'),
        ]);

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');

            if ($profilePhoto->isValid() && strpos($profilePhoto->getMimeType(), 'image/') === 0) {
                $folderName = 'profile photo';
                $fileName = now()->format('YmdHis') . '-' . $profilePhoto->getClientOriginalName();

                $profilePhoto->move(public_path('upload/' . $folderName), $fileName);

                $user->update([
                    'profile_photo' => $fileName,
                ]);
            }
        }

        return redirect()->route('profile.index')
            ->with('success', 'About Me berhasil diperbarui.');
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

        return redirect()->route('profile.index')
            ->with('success', 'Password berhasil diperbarui.');
    }

    public function showHistory()
    {
        $history = CatatanKeuangan::orderBy('tanggal_transaksi', 'desc')->get();
        return View::make('profile.index', compact('history'));
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo) {
            $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }

            $user->profile_photo = null;
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Foto Profile berhasil dihapus.');
        }

        return redirect()->route('profile.index')->with('error', 'Foto Profile gagal dihapus.');
    }
}
