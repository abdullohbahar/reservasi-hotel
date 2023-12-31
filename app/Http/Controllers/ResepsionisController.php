<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tamu;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Presence;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use App\Models\Transaksi;
use App\Models\Resepsionis;
use Illuminate\Http\Request;
use App\Models\PendapatanLainnya;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResepsionisController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('role') == 'Admin') {
                return redirect('dashboard/admin');
            } else if (session('role') == 'Resepsionis') {
                return $next($request);
            } else if (session('role') == 'Tamu') {
                return redirect('dashboard/tamu');
            } else {
                return redirect('dashboard/tamudefault');
            }
        });
    }

    // Main Menu
    public function index()
    {
        // mengambil data pendapatan
        $queryPendapatan =
            DB::table('reservasis as r')
            ->join('transaksis as t', 'r.id', '=', 't.reservasi_id')
            ->selectRaw('YEAR(r.checkin) as Tahun, 
                 MONTH(r.checkin) as Bulan, 
                 COUNT(*) as JumlahPengunjung, 
                 SUM(t.total_biaya) as TotalBiaya')
            ->groupByRaw('YEAR(r.checkin), MONTH(r.checkin)')
            ->orderByRaw('Tahun ASC, Bulan ASC')
            ->where('r.status', 'free')
            ->get();


        $currentYear = Carbon::now()->year; // Mendapatkan tahun saat ini
        $currentMonth = Carbon::now()->month; // Mendapatkan bulan saat ini

        $queryChart = DB::table('reservasis as r')
            ->join('transaksis as t', 'r.id', '=', 't.reservasi_id')
            ->join('kamars as k', 'r.tipe_kamar_id', '=', 'k.id')
            ->join('tipe_kamars as tk', 'k.tipe_kamar_id', '=', 'tk.id')
            ->selectRaw('tk.tipe_kamar as TipeKamar,
                 YEAR(r.checkin) as Tahun,
                 MONTH(r.checkin) as Bulan,
                 COUNT(*) as JumlahPengunjung,
                 SUM(t.total_biaya) as TotalBiaya')
            ->whereYear('r.checkin', $currentYear) // Menambahkan kondisi tahun
            ->whereMonth('r.checkin', $currentMonth) // Menambahkan kondisi bulan
            ->groupByRaw('tk.tipe_kamar, YEAR(r.checkin), MONTH(r.checkin)')
            ->orderByRaw('Tahun ASC, Bulan ASC, TipeKamar ASC')
            ->where('r.status', 'free')
            ->get();

        $totalBiayaKeseluruhan = $queryChart->sum('TotalBiaya'); // Menghitung total biaya keseluruhan

        $dataCanvasJS = [];

        foreach ($queryChart as $result) {
            $persentase = ($result->TotalBiaya / $totalBiayaKeseluruhan) * 100;
            $dataCanvasJS[] = [
                'y' => round($persentase),
                'label' => $result->TipeKamar
            ];
        }

        $data = [
            'pendapatan' => $queryPendapatan,
            'dataCanvasJs' => json_encode($dataCanvasJS)
        ];

        return view('resepsionis/menu/dashboard', $data);
    }
    public function absenresepsionis()
    {
        return view('resepsionis/menu/absen');
    }
    public function simpanabsen(Request $request)
    {
        Presence::create([
            'resepsionis_id' => session('user')->id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'berhasil presensi');
    }

    public function listtamukamar()
    {
        $reservasi = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->join('kamars', 'reservasis.kamar_id', '=', 'kamars.id')
            ->join('transaksis', 'reservasis.id', '=', 'transaksis.reservasi_id')
            ->join('tamus', 'tamus.id', '=', 'reservasis.tamu_id')
            ->select(
                'tipe_kamars.tipe_kamar',
                'tipe_kamars.harga',
                'reservasis.*',
                'kamars.no_kamar',
                'transaksis.status_pembayaran',
                'transaksis.bukti_pembayaran',
                'transaksis.id as transaksi_id',
                'tamus.nama as nama_tamu',
                'reservasis.status'
            )
            ->where('reservasis.status', '=', 'full')
            ->orderBy('reservasis.no_booking', 'desc')
            ->get();

        $data = [
            'reservasi' => $reservasi
        ];

        return view('resepsionis/menu/listtamukamar', $data);
    }
    public function checkout($id)
    {
        Reservasi::where('id', $id)->update([
            'status' => 'free'
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function laporanresepsionis()
    {
        $reservasi = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->select('reservasis.checkin', 'tipe_kamars.harga', 'tipe_kamars.tipe_kamar')
            ->where('reservasis.status', 'free')
            ->orderBy('reservasis.checkin', 'desc')
            ->get();

        $pendapatanLainnya = PendapatanLainnya::orderBy('tanggal', 'desc')->get();

        $data = [
            'pendapatan' => $reservasi,
            'pendapatanLainnya' => $pendapatanLainnya
        ];

        return view('resepsionis/menu/laporan', $data);
    }
    public function simpanPendapatanLainnya(Request $request)
    {
        $data = [
            'keterangan' => $request->input('keterangan'),
            'total_biaya' => $request->input('total_biaya'),
            'tanggal' => date('Y-m-d'),
        ];

        $file = $request->file('bukti');
        $filename = date('His') . "." . $file->getClientOriginalExtension();
        $location = 'image/pendapatan-lainnya/';
        $filepath = $location . $filename;
        $file->move($location, $filename);
        $data['bukti'] = $filepath;

        PendapatanLainnya::create($data);
        return redirect('laporan/resepsionis');
    }

    // Reservasi Online
    public function ronpesan()
    {
        $reservasi = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->join('kamars', 'reservasis.kamar_id', '=', 'kamars.id')
            ->join('transaksis', 'reservasis.id', '=', 'transaksis.reservasi_id')
            ->join('tamus', 'tamus.id', '=', 'reservasis.tamu_id')
            ->select(
                'tipe_kamars.tipe_kamar',
                'tipe_kamars.harga',
                'reservasis.*',
                'kamars.no_kamar',
                'transaksis.status_pembayaran',
                'transaksis.bukti_pembayaran',
                'transaksis.id as transaksi_id',
                'tamus.nama as nama_tamu',
                'reservasis.status'
            )
            ->where('reservasis.status', 'menunggu pembayaran')
            ->orderBy('reservasis.no_booking', 'desc')
            ->get();

        $data = [
            'reservasi' => $reservasi
        ];

        return view('resepsionis/menu/pesan', $data);
    }
    public function konfirmasi($id)
    {
        Transaksi::where('id', $id)->update([
            'status_pembayaran' => 'pending'
        ]);

        Reservasi::where('id', $id)->update([
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'OK'
        ]);
    }
    public function tolak(Request $request)
    {
        $id = $request->id;

        Transaksi::where('id', $id)->update([
            'status_pembayaran' => 'tolak'
        ]);

        Reservasi::where('id', $id)->update([
            'status' => 'tolak',
            'alasan' => $request->alasan
        ]);

        return redirect()->back()->with('success', 'Berhasil Menolak');
    }

    public function ronnobooking()
    {
        $reservasi = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->join('kamars', 'reservasis.kamar_id', '=', 'kamars.id')
            ->join('transaksis', 'reservasis.id', '=', 'transaksis.reservasi_id')
            ->join('tamus', 'tamus.id', '=', 'reservasis.tamu_id')
            ->select(
                'tipe_kamars.tipe_kamar',
                'tipe_kamars.harga',
                'reservasis.*',
                'kamars.no_kamar',
                'transaksis.status_pembayaran',
                'transaksis.bukti_pembayaran',
                'transaksis.id as transaksi_id',
                'tamus.nama as nama_tamu',
                'reservasis.status'
            )
            ->where('reservasis.status', '=', 'pending')
            ->orderBy('reservasis.no_booking', 'desc')
            ->get();

        $data = [
            'reservasi' => $reservasi
        ];

        return view('resepsionis/menu/nobooking', $data);
    }
    public function konfirmasiNobooking($id)
    {
        Reservasi::where('id', $id)->update([
            'status' => 'full'
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'OK'
        ]);
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
            'kamar_id' => $request->kamar_id,
            'resepsionis_id' => session('user')->id
        ];

        // simpan data ke Reservasi table
        $saveReservasi = Reservasi::create($dataReservasi);

        $startDate = Carbon::createFromFormat('Y-m-d', $request->checkin);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->checkout);

        $jumlahHari = $endDate->diffInDays($startDate);

        Transaksi::create([
            'tgl_transaksi' => now(),
            'metode_pembayaran' => 'cash',
            'total_biaya' => $request->total_biaya * $jumlahHari,
            'reservasi_id' => $saveReservasi->id,
            'tamu_id' => $tamu->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil');
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

    public function tambahPendapatanLainnya()
    {
        return view('resepsionis.menu.pendapatanlainnya');
    }
}
