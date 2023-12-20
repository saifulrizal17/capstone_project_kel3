<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerubahanModal;

class PerubahanModalAjaxController extends Controller
{
    public function destroy(Request $request, $id)
    {
        try {
            $perubahanModal = PerubahanModal::find($id);

            if (!$perubahanModal) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $perubahanModal->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting data', 'details' => $e->getMessage()], 500);
        }
    }
}
