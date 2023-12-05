<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

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
    // simpan reservasi office
    public function rofstore(Request $request)
    {
        // dd($request->all());

        // Proses Tamu
        $tamu = Tamu::create([
            'gambar' => 'Profile.jpeg',
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => "-",
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'password' => Hash::make($request->email),
        ]);

        // Proses Reservasi
        $lastBooking = Reservasi::orderBy('created_at', 'desc')->first();

        if ($lastBooking) {
            $lastNumber = (int) substr($lastBooking->no_booking, 0, 2);
            $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '01';
        }

        $currentDate = now();
        $bookingNumber = $newNumber . '/' . $currentDate->format('d/m/Y');

        $dataReservasi = [
            'no_booking' => $bookingNumber,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'tamu_id' => $tamu->id,
            'tipe_kamar_id' => $request->tipe_kamar,
            'status' => 'full',
            // 'resepsionis_id' => '1'
        ];

        // simpan data ke Reservasi table
        $saveReservasi = Reservasi::create($dataReservasi);

        Transaksi::create([
            'tgl_transaksi' => now(),
            'metode_pembayaran' => 'cash',
            'total_biaya' => $request->total_biaya,
            'reservasi_id' => $saveReservasi->id,
            'tamu_id' => $tamu->id,
        ]);

        dd("berhasil");
    }

    public function GetTipeKamarPrice($id)
    {
        $tipe = TipeKamar::where('id', $id)->first();

        return response()->json([
            'price' => $tipe->harga
        ]);
    }

    public function rofpembayaran()
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
