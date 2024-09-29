<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pqr;
use DB;

class PqrController extends Controller
{
    public function index()
    {
        $pqrs = Pqr::with('user')->get(); // Carga los usuarios relacionados
        return response()->json(['success' => true, 'data' => $pqrs, 'message' => 'List of PQRs'], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pqr_date' => 'required|date',
            'pqr_type' => 'required|string|max:50',
            'pqr_methodnotify' => 'required|boolean',
            'pqr_cause' => 'required|string',
            'pqr_observation' => 'nullable|string',
            'pqr_evidence' => 'nullable|string',
            'user_id' => 'required|exists:users,user_id',
        ]);

        DB::beginTransaction();
        try {
            $pqr = Pqr::create($validated);
            DB::commit();
            return response()->json(['success' => true, 'data' => $pqr, 'message' => 'PQR created successfully'], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $pqr = Pqr::with('user')->findOrFail($id); // Carga el usuario relacionado
        return response()->json(['success' => true, 'data' => $pqr], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pqr_date' => 'sometimes|required|date',
            'pqr_type' => 'sometimes|required|string|max:50',
            'pqr_methodnotify' => 'sometimes|required|boolean',
            'pqr_cause' => 'sometimes|required|string',
            'pqr_observation' => 'nullable|string',
            'pqr_evidence' => 'nullable|string',
            'user_id' => 'sometimes|required|exists:users,user_id',
        ]);

        DB::beginTransaction();
        try {
            $pqr = Pqr::findOrFail($id);
            $pqr->update($validated);
            DB::commit();
            return response()->json(['success' => true, 'data' => $pqr, 'message' => 'PQR updated successfully'], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pqr = Pqr::findOrFail($id);
            $pqr->delete();
            return response()->json(['success' => true, 'message' => 'PQR deleted successfully'], 200);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'PQR not found or failed to delete'], 404);
        }
    }
}
