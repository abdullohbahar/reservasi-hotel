<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResepsionisController extends Controller
{
    // Main Menu
    public function index()
    {
        return view('resepsionis/menu/dashboard');
    }
    public function absenresepsionis()
    {
        return view('resepsionis/menu/absen');
    }
    public function listtamukamar()
    {
        return view('resepsionis/menu/listtamukamar');
    }
    public function laporanresepsionis()
    {
        return view('resepsionis/menu/laporan');
    }

    // Reservasi Online
    public function ronpesan()
    {
        return view('resepsionis/menu/pesan');
    }
    public function ronnobooking()
    {
        return view('resepsionis/menu/nobooking');
    }


    // Reservasi Office
    public function rofdaftar()
    {
        $tipekamar = TipeKamar::all();
        $data = [
            'tipekamar' => $tipekamar,
        ];
        return view('resepsionis/menu/daftar', $data);
    }
    public function  rofpembayaran()
    {
        return view('resepsionis/menu/pembayaran');
    }
    // Reservasi penyimpanan Office
    public function tamustore(Request $request)
    {
        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'no_wa' => $request->input('no_wa'),
            'chekin' => $request->input('chekin'),
            'checkout' => $request->input('checkout'),
            'tipekamar' => $request->input('tipekamar'),
            'total_biaya' => $request->input('total_biaya'),
        ];

        User::create($data);
        return redirect('list/resepsionis');
    }

    // Detail
    public function profilresepsionis()
    {
        return view('resepsionis/menu/profil');
    }
    public function detailtamu()
    {
        return view('resepsionis/layout/detailtamu');
    }
}
