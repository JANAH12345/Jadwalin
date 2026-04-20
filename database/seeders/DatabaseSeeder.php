<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat atau update user admin syaifatul
        User::updateOrCreate(
            ['email' => 'syaifatul@example.com'],
            [
                'name' => 'syaifatul',
                'password' => Hash::make('adminibik123'),
                'role' => 'admin',
            ]
        );

        // Buat atau update user marketing afrida
        User::updateOrCreate(
            ['email' => 'afrida@example.com'],
            [
                'name' => 'afrida',
                'password' => Hash::make('marketingibik123'),
                'role' => 'marketing',
            ]
        );

        // Buat dummy jadwal jika masih kosong
        if (Jadwal::count() == 0) {
            $now = Carbon::now();
            
            Jadwal::insert([
                [
                    'nama_kegiatan' => 'Promosi ke SMPN 1 Kota',
                    'nama_tempat' => 'SMPN 1 Kota Bandung',
                    'tanggal' => $now->toDateString(),
                    'jam' => '09:00:00',
                    'status' => 'hari ini',
                    'keterangan' => 'Membawa leaflet dan rollbanner'
                ],
                [
                    'nama_kegiatan' => 'Open House SMK',
                    'nama_tempat' => 'Aula Sekolah',
                    'tanggal' => $now->addDays(5)->toDateString(),
                    'jam' => '08:00:00',
                    'status' => 'ada jadwal',
                    'keterangan' => 'Undang SMP sekitar'
                ],
                [
                    'nama_kegiatan' => 'Presentasi di MTsN 2',
                    'nama_tempat' => 'MTsN 2 Kota',
                    'tanggal' => $now->subDays(5)->toDateString(),
                    'jam' => '10:00:00',
                    'status' => 'selesai',
                    'keterangan' => 'Sudah terlaksana dengan baik'
                ],
                [
                    'nama_kegiatan' => 'Kunjungan ke SMP Swasta',
                    'nama_tempat' => 'SMP Al-Ikhlas',
                    'tanggal' => $now->subDays(10)->toDateString(),
                    'jam' => '13:00:00',
                    'status' => 'batal',
                    'keterangan' => 'Ditunda karena cuaca buruk'
                ]
            ]);
        }
    }
}
