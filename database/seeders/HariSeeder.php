<?php

namespace Database\Seeders;

use App\Models\Hari;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mulai dari tanggal 1 Januari 2024
        $startDate = Carbon::create(2024, 1, 1);
        // Sampai dengan tanggal 31 Desember 2024
        $endDate = Carbon::create(2024, 12, 31);

        // Loop dari hari pertama sampai terakhir
        while ($startDate->lte($endDate)) {
            // Cek apakah hari ini Sabtu atau Minggu
            $isHoliday = $startDate->isWeekend(); // Sabtu/Minggu akan return true

            // Buat instance baru di model Hari
            Hari::create([
                'tanggal' => $startDate->format('Y-m-d'),
                'is_holiday' => $isHoliday,
            ]);

            // Lanjut ke hari berikutnya
            $startDate->addDay();
        }
    }
}
