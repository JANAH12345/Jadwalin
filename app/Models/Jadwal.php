<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'nama_tempat',
        'tanggal',
        'jam',
        'status',
        'keterangan',
    ];

    /**
     * Sinkronisasi status jadwal berdasarkan tanggal hari ini.
     */
    public static function syncStatuses()
    {
        $today = now()->toDateString();

        // 1. Tanggal lewat (kemarin dst) -> Selesai
        // Kecuali jika statusnya 'batal'
        self::where('tanggal', '<', $today)
            ->whereNotIn('status', ['selesai', 'batal'])
            ->update(['status' => 'selesai']);

        // 2. Tanggal hari ini -> Hari Ini
        // Hanya jika statusnya 'ada jadwal' (agar tidak menimpa 'selesai' atau 'batal' yang sudah diset manual)
        self::where('tanggal', '=', $today)
            ->where('status', 'ada jadwal')
            ->update(['status' => 'hari ini']);

        // 3. Tanggal depan -> Ada Jadwal
        // Jika statusnya 'hari ini' tapi tanggalnya di masa depan (misal admin ganti tanggal mundur)
        self::where('tanggal', '>', $today)
            ->where('status', 'hari ini')
            ->update(['status' => 'ada jadwal']);
    }
}
