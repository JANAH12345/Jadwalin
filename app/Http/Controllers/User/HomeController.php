<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman Landing Page Publik
    public function index()
    {
        return view('user.landing');
    }

    // Halaman Kalender (Memerlukan Auth Middleware)
    public function kalender()
    {
        $jadwals = Jadwal::orderBy('tanggal', 'asc')->get();
        
        // Statistik untuk marketing
        $stats = [
            'total'     => $jadwals->count(),
            'hari_ini'  => $jadwals->where('tanggal', date('Y-m-d'))->count(),
            'selesai'   => $jadwals->where('status', 'selesai')->count(),
            'mendatang' => $jadwals->where('tanggal', '>', date('Y-m-d'))->where('status', '!=', 'batal')->take(5)
        ];

        return view('user.kalender', compact('jadwals', 'stats'));
    }
}
