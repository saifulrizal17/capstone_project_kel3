<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Imports\ManajemenUsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;




class ManajemenUsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
            'phone_number' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $validatedData['role_id'] = 2;
        $validatedData['is_active'] = 1;
        $validatedData['email_verified_at'] = now();
        $validatedData['password'] = Hash::make($request->input('password'));
        $validatedData['remember_token'] = Str::random(60);

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $folderName = 'profile photo';
            $fileName = now()->format('YmdHis') . '-' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('upload/' . $folderName), $fileName);
            $validatedData['profile_photo'] = $fileName;
        }

        $user = User::create($validatedData);

        return redirect()->route('admin.users.index', $user->id)
            ->with('success', 'User berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'job_title' => 'required|string|max:255',
            'address' => 'required|string',
            'is_active' => 'required|boolean',
            'profile_photo' => 'nullable|file|max:2048',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'job_title' => $request->input('job_title'),
            'address' => $request->input('address'),
            'role_id' => 2,
            'email_verified_at' => now(),
            'remember_token' => Str::random(60),
            'is_active' => $request->input('is_active'),
        ];

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $folderName = 'profile photo';
            $fileName = now()->format('YmdHis') . '-' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('upload/' . $folderName), $fileName);

            if ($user->profile_photo) {
                $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            $data['profile_photo'] = $fileName;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function deleteProfilePhoto(User $user)
    {
        if ($user->profile_photo) {
            $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }

            $user->profile_photo = null;
            $user->save();

            return redirect()->route('admin.users.edit', ['user' => $user])->with('success', 'Foto Profile berhasil dihapus.');
        }

        return redirect()->route('admin.users.edit', ['user' => $user])->with('error', 'Foto Profile gagal dihapus.');
    }

    public function destroy(User $user)
    {

        if ($user->profile_photo) {
            $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }
        }
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function resetPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.users.index')
                ->with('error', 'User tidak ditemukan.');
        }

        $defaultPassword = '12345678';
        $hashedPassword = Hash::make($defaultPassword);

        $user->update(['password' => $hashedPassword]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Password berhasil direset.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new ManajemenUsersImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully.');
    }

    public function downloadTemplate()
    {
        $templatePath = public_path('templates/users_template.xlsx');

        if (file_exists($templatePath)) {
            $fileName = 'users_template.xlsx';

            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            return response()->download($templatePath, $fileName, $headers);
        }

        abort(404, 'Template file not found');
    }
}
