<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Admin Dashboard beserta Load Data Awal.
     */
    public function index()
    {
        $jadwals    = Jadwal::orderBy('tanggal', 'desc')->get();
        $marketings = User::where('role', 'marketing')->orderBy('name', 'asc')->get();
        $admins     = User::where('role', 'admin')->orderBy('name', 'asc')->get();

        return view('admin.dashboard', compact('jadwals', 'marketings', 'admins'));
    }

    /**
     * Simpan jadwal baru dari Fetch API.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'nama_tempat'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'jam'           => 'required',
            'status'        => 'required|in:ada jadwal,hari ini,selesai,batal',
            'keterangan'    => 'nullable|string'
        ]);

        $jadwal = Jadwal::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil ditambahkan!',
            'data'    => $jadwal
        ]);
    }

    /**
     * Update jadwal eksisting dari Fetch API.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'nama_tempat'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'jam'           => 'required',
            'status'        => 'required|in:ada jadwal,hari ini,selesai,batal',
            'keterangan'    => 'nullable|string'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diperbarui!',
            'data'    => $jadwal
        ]);
    }

    /**
     * Hapus jadwal eksisting dari Fetch API.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus!'
        ]);
    }

}
