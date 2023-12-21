<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class ManajemenUsersAjaxController extends Controller
{
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            if ($user->profile_photo) {
                $existingFilePath = public_path('upload/profile photo/' . $user->profile_photo);

                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting user', 'details' => $e->getMessage()], 500);
        }
    }

    public function resetPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        $defaultPassword = '12345678';
        $hashedPassword = Hash::make($defaultPassword);

        $user->update(['password' => $hashedPassword]);

        return response()->json(['message' => 'Password berhasil direset.']);
    }
}
