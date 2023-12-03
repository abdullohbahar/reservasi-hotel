<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TamuController extends Controller
{
    // tamu default
    public function default()
    {
        return view('tamu/menu/defaultdashboard');
    }
    public function pesankamardefault()
    {
        return view('tamu/menu/defaultpesankamar');
    }
    public function pembayarandefault()
    {
        return view('tamu/menu/defaultpembayaran');
    }

    // tamu user
    public function profil()
    {
        return view('tamu/menu/profil');
    }
    public function dashboard()
    {
        $tipekamar = TipeKamar::all();
        $data = [
            'tipekamar' => $tipekamar,
        ];
        return view('tamu/menu/dashboard', $data);
    }
    public function pesankamar()
    {
        $tipekamar = TipeKamar::all();
        $data = [
            'tipekamar' => $tipekamar,
        ];
        return view('tamu/menu/pesankamar', $data);
    }
    public function pembayaran()
    {
        return view('tamu/menu/pembayaran');
    }
}
