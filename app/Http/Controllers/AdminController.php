<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kamar;
use App\Models\Presence;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use App\Models\Resepsionis;
use Illuminate\Http\Request;
use App\Models\PendapatanLainnya;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('role') == 'Admin') {
                return $next($request);
            } else if (session('role') == 'Resepsionis') {
                return redirect('dashboard/resepsionis');
            } else if (session('role') == 'Tamu') {
                return redirect('dashboard/tamu');
            } else {
                return redirect('dashboard/tamudefault');
            }
        });
    }

    // Dashboard Admin :
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

        // dd($queryPendapatan);

        $data = [
            'pendapatan' => $queryPendapatan,
            'dataCanvasJs' => json_encode($dataCanvasJS)
        ];

        return view('admin/menu/dashboard', $data);
    }

    // - list Resepsionis
    public function listresepsionis()
    {
        $resepsionis = Resepsionis::all();
        $data = [
            'resepsionis' => $resepsionis,
        ];
        return view('admin/menu/resepsionis/listresepsionis', $data);
    }

    // - halaman tambah,edit,hapus resepsionis
    public function editresepsionis()
    {
        $resepsionisedit = Resepsionis::all();
        $data = [
            'resepsionisedit' => $resepsionisedit,
        ];
        return view('admin/menu/resepsionis/editresepsionis', $data);
    }
    //logika simpan resepsionis dari atas:
    public function resepsionisstore(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:tamus,nik|unique:resepsionis,nik',
            'nama' => 'required',
            'alamat' => 'required',
            'no_wa' => 'required|unique:tamus,no_wa|unique:resepsionis,no_wa',
            'email' => 'required|unique:tamus,email|unique:resepsionis,email|unique:admins,email',
            'password' => 'required'
        ]);

        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_wa' => $request->input('no_wa'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];
        Resepsionis::create($data);
        return redirect('listresepsionis/admin');
    }
    public function getResepsionis($id)
    {
        $resepsionis = Resepsionis::where('id', $id)->first();

        return response()->json([
            'resepsionis' => $resepsionis
        ]);
    }
    public function resepsionisdestroy($id)
    {
        Resepsionis::where('id', $id)->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
    // Update Resepsionis
    public function updateresepsionis(Request $request)
    {
        $request->validate([
            'editnama' => 'required',
            'editalamat' => 'required',
            'editnik' => 'required',
            'editno_wa' => 'required',
        ]);

        // mengambil data resepsionis sekarang
        $resepsionis = Resepsionis::findorfail($request->input('id'));

        if ($request->nik != $resepsionis->nik) {
            $request->validate([
                'editnik' => 'unique:tamus,nik|unique:resepsionis,nik',
            ]);
        }

        if ($request->no_wa != $resepsionis->no_wa) {
            $request->validate([
                'editno_wa' => 'required',
            ]);
        }

        // if ($request->email != $resepsionis->email) {
        //     $request->validate([
        //         'editemail' => 'required|unique:tamus,email|unique:resepsionis,email|unique:admins,email',
        //     ]);
        // }

        $data = [
            'nik' => $request->input('editnik'),
            'nama' => $request->input('editnama'),
            'alamat' => $request->input('editalamat'),
            'no_wa' => $request->input('editno_wa'),
        ];

        Resepsionis::where('id', $request->input('id'))->update($data);
        return redirect('editresepsionis/admin');
    }

    // Kamar
    public function listkamar()
    {
        $kamar = Kamar::join('tipe_kamars', 'kamars.tipe_kamar_id', 'tipe_kamars.id')
            ->select('tipe_kamars.*', 'kamars.*')
            ->get();

        $data = [
            'kamars' => $kamar,
        ];

        return view('admin/menu/kamar/listkamar', $data);
    }
    public function editkamar()
    {
        $kamar = Kamar::all();
        $tipekamar = TipeKamar::all();
        $data = [
            'tipekamar' => $tipekamar,
            'no_kamar' => $kamar,
        ];
        return view('admin/menu/kamar/editkamar', $data);
    }
    public function kamarstore(Request $request)
    {
        $data = [
            'no_kamar' => $request->input('no_kamar'),
            'tipe_kamar_id' => $request->input('tipe_kamar_id')
        ];
        Kamar::create($data);
        return redirect('listkamar/admin');
    }
    //logika simpan Tipe kamar dari atas:
    public function tipekamarstore(Request $request)
    {
        $data = [
            'tipe_kamar' => $request->input('tipe_kamar'),
            'harga' => $request->input('harga'),
            'fasilitas' => $request->input('fasilitas'),
        ];
        $file = $request->file('gambar');
        $filename = date('His') . "." . $file->getClientOriginalExtension();
        $location = 'image/kamar/';
        $filepath = $location . $filename;
        $file->move($location, $filename);
        $data['gambar'] = $filepath;

        TipeKamar::create($data);
        return redirect('listkamar/admin');
    }
    public function destroynokamar($id)
    {
        Kamar::where('id', $id)->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
    public function destroytipekamar($id)
    {
        TipeKamar::where('id', $id)->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
    // Update Kamar
    public function gettipekamar($id)
    {
        $tipekamar = TipeKamar::where('id', $id)->first();

        return response()->json([
            'TipeKamar' => $tipekamar
        ]);
    }
    public function updatenokamar(Request $request)
    {
        $data = [
            'no_kamar' => $request->input('no_kamar'),
        ];
        Kamar::where('id', $request->input('id'))->update($data);
        return redirect('editkamar/admin');
    }
    public function updatetipekamar(Request $request)
    {
        $data = [
            'harga' => $request->input('harga'),
            'fasilitas' => $request->input('fasilitas'),
        ];
        if ($request->has('gambar')) {
            $file = $request->file('gambar');
            $filename = date('His') . "." . $file->getClientOriginalExtension();
            $location = 'image/kamar/';
            $filepath = $location . $filename;
            $file->move($location, $filename);
            $data['gambar'] = $filepath;
        }
        TipeKamar::where('id', $request->input('id'))->update($data);
        return redirect('editkamar/admin');
    }
    // Laporan
    public function absenview()
    {
        $presensi = Presence::join('resepsionis', 'presences.resepsionis_id', '=', 'resepsionis_id')
            ->select(
                'resepsionis.nama',
                'presences.created_at as tanggal',
                'presences.keterangan'
            )
            ->orderBy('resepsionis.nama', 'asc')
            ->get();

        $data = [
            'presensi' => $presensi
        ];

        return view('admin/menu/laporan/absen', $data);
    }
    public function pendapatanview()
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

        return view('admin/menu/laporan/pendapatans', $data);
    }
}
