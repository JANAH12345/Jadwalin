<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,name',
            'role'     => 'required|in:admin,marketing',
        ]);

        $password = $validated['role'] === 'admin' ? 'adminibik123' : 'marketingibik123';
        
        $user = User::create([
            'name'     => $validated['username'],
            'password' => Hash::make($password),
            'role'     => $validated['role'],
        ]);

        $label = $validated['role'] === 'admin' ? 'Petugas' : 'Marketing';
        
        return response()->json([
            'success' => true,
            'message' => $label . ' berhasil ditambahkan!',
            'data'    => $user
        ]);
    }

    /**
     * Update user. (Hanya ganti username)
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,name,' . $id,
        ]);

        $user->update([
            'name'  => $validated['username'],
        ]);

        $label = $user->role === 'admin' ? 'Petugas' : 'Marketing';
        
        return response()->json([
            'success' => true,
            'message' => $label . ' berhasil diperbarui!',
            'data'    => $user
        ]);
    }

    /**
     * Hapus user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Proteksi jangan hapus diri sendiri
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun Anda sendiri!'
            ], 403);
        }

        $user->delete();

        $label = $user->role === 'admin' ? 'Petugas' : 'Marketing';
        
        return response()->json([
            'success' => true,
            'message' => $label . ' berhasil dihapus!'
        ]);
    }
}
