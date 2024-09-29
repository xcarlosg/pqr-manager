<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['success' => true, 'data' => $users, 'message' => 'List of Users'], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_identification' => 'required|string|max:50',
            'user_name' => 'required|string|max:255',
            'user_lastname' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email',
            'user_password' => 'required|string|min:6',
            'user_rol' => 'required|string|max:50',
        ]);

        DB::beginTransaction();
        try {
            $validated['user_password'] = bcrypt($validated['user_password']);
            $user = User::create($validated);
            DB::commit();
            return response()->json(['success' => true, 'data' => $user, 'message' => 'User created successfully'], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['success' => true, 'data' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_identification' => 'sometimes|required|string|max:50',
            'user_name' => 'sometimes|required|string|max:255',
            'user_lastname' => 'sometimes|required|string|max:255',
            'user_email' => 'sometimes|required|email|unique:users,user_email,'.$id.',user_id',
            'user_password' => 'nullable|string|min:6',
            'user_rol' => 'sometimes|required|string|max:50',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if ($request->has('user_password')) {
                $validated['user_password'] = bcrypt($validated['user_password']);
            }
            $user->update($validated);
            DB::commit();
            return response()->json(['success' => true, 'data' => $user, 'message' => 'User updated successfully'], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'User not found or failed to delete'], 404);
        }
    }
}
