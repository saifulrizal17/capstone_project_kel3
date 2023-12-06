<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
        // return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
            'phone_number' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validatedData['role_id'] = 2;
        $validatedData['is_active'] = 1;
        $validatedData['email_verified_at'] = now();
        $validatedData['password'] = Hash::make($request->input('password'));
        $validatedData['remember_token'] = Str::random(60);

        $user = User::create($validatedData);

        return redirect()->route('admin.users.index', $user->id)
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users,email,' . $id],
            'phone_number' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_active' => ['required', 'boolean'], // Menambahkan aturan validasi untuk is_active
        ]);

        // Menambahkan kolom email_verified_at dan remember_token
        $validatedData['role_id'] = 2;
        $validatedData['email_verified_at'] = now();

        // Memeriksa apakah password diisi atau tidak sebelum menghash
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        $validatedData['remember_token'] = Str::random(60);

        // Mengupdate is_active sesuai dengan nilai yang dipilih
        $validatedData['is_active'] = $request->input('is_active');

        // Update user berdasarkan ID
        User::findOrFail($id)->update($validatedData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
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

        // Set password default
        $defaultPassword = '12345678';
        $hashedPassword = Hash::make($defaultPassword);

        // Update password user
        $user->update(['password' => $hashedPassword]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Password berhasil direset.');
    }
}
