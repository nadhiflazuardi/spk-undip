<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = 'hari';

    protected $guarded = ['id'];

    public static function hitungHariKerja(): int
    {
        // Ambil tanggal hari ini
        $today = Carbon::today();
        // Ambil tanggal 1 Januari tahun ini
        $startOfYear = Carbon::create($today->year, 1, 1);

        // Hitung jumlah hari yang bukan weekend dan tanggalnya >= 1 Januari dan <= hari ini
        $jumlahHariKerja = Hari::where('is_holiday', false)
            ->whereDate('tanggal', '>=', $startOfYear)  // Start dari 1 Januari
            ->whereDate('tanggal', '<=', $today)        // Sampai hari ini
            ->count();

        return $jumlahHariKerja;
    }
}
