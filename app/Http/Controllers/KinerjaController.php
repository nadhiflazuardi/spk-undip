<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KinerjaController extends Controller
{
    public function show($id)
    {
        $title = 'Kinerja Pegawai';

        $pegawai = User::find($id);

        $jumlahHariKerja = Hari::hitungHariKerja();

        // Fetch data log dari API
        $logResponse = Http::get("http://e-office-undip.test/api/log/{$id}",[
            'bulan' => Carbon::now()->month,
            'tahun' => Carbon::now()->year,
        ]);

        // Cek apakah request berhasil
        if ($logResponse->successful()) {
            // Olah data yang didapat
            $logs = collect($logResponse->json('data'));
        } else {
            $logs = [];
        }

        return view('show', compact('title', 'jumlahHariKerja', 'logs', 'pegawai'));
    }

    public function downloadLaporan($id, Request $request)
    {
      $request->validate([
          'bulan' => 'required|numeric|between:1,12',
          'tahun' => 'required|numeric|max_digits:4',
      ]);
        $pegawai = User::find($id);
        $bulan = Carbon::parse($request->tahun . '-' . $request->bulan . '-01')->translatedFormat('F');
        $tahun = $request->tahun;
        $logResponse = Http::get("http://e-office-undip.test/api/log/{$id}", [
            'bulan' => $request->bulan,
            'tahun' => $tahun,
        ]);

        if ($logResponse->successful()) {
            $logs = collect($logResponse->json('data'));
        } else {
            $logs = [];
        }

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('laporan.template', compact('pegawai','logs','bulan','tahun'))->render());

        return $mpdf->OutputHttpDownload('kinerja-pegawai_' . $pegawai->nama . "_" . $bulan. '-' . $tahun . '.pdf');
    }
}
