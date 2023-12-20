<?php

namespace App\Http\Controllers;

use App\CatatanKeuangan;
use Illuminate\Http\Request;

class CatatanKeuanganAjaxController extends Controller
{
    public function destroy(Request $request, $id)
    {
        try {
            $catatanKeuangan = CatatanKeuangan::find($id);

            if (!$catatanKeuangan) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $catatanKeuangan->delete();

            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting data', 'details' => $e->getMessage()], 500);
        }
    }
}
