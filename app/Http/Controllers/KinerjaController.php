<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\User;
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
    $logResponse = Http::get("http://e-office-undip.test/api/log/{$id}");

    // Cek apakah request berhasil
    if ($logResponse->successful()) {
      // Olah data yang didapat
      $logs = collect($logResponse->json('data'));
    } else {
      $logs = [];
    }

    return view('show', compact('title', 'jumlahHariKerja', 'logs', 'pegawai'));
  }
}
