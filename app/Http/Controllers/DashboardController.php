<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

use function GuzzleHttp\Promise\settle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $jumlahHariKerja = Hari::hitungHariKerja();

        // Ambil ID user yang login
        $userId = Auth::id();

        // Fetch data log dari API
        $logResponse = Http::get("http://e-office-undip.test/api/log/{$userId}");

        // Cek apakah request berhasil
        if ($logResponse->successful()) {
            // Olah data yang didapat
            $logs = collect($logResponse->json('data')); // Ini mengubah response ke array
        } else {
            // Handle error, misalnya
            $logs = []; // Atau bisa juga return error message
        }
        
        return view('dashboard', compact('title', 'jumlahHariKerja', 'logs'));
    }
}
