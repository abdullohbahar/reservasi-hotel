<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tamu;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use PDF;

class TamuController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('role') == 'Admin') {
                return redirect('dashboard/admin');
            } else if (session('role') == 'Resepsionis') {
                return redirect('dashboard/resepsionis');
            } else if (session('role') == 'Tamu') {
                return $next($request);
            } else {
                return redirect('dashboard/tamudefault');
            }
        });
    }

    // tamu user
    public function profil()
    {
        $id = session('user')->id;
        $tamu = Tamu::where('id', $id)->first();

        $data = [
            'tamu' => $tamu,
            'id' => $id
        ];

        return view('tamu/menu/profil', $data);
    }
    public function ubahProfile(Request $request)
    {
        $id = session('user')->id;

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        Tamu::where('id', $id)->update($data);

        $user = Tamu::where('id', $id)->first();

        $request->session()->put('user', $user);

        return redirect('profil/tamu')->with('success-profile', 'Berhasil Mengubah Profile');
    }
    public function ubahFoto(Request $request)
    {
        $id = session('user')->id;

        $file = $request->file('gambar');
        $filename = date('His') . "." . $file->getClientOriginalExtension();
        $location = 'image/kamar/';
        $filepath = $location . $filename;
        $file->move($location, $filename);
        $data['gambar'] = $filepath;

        Tamu::where('id', $id)->update($data);

        $user = Tamu::where('id', $id)->first();

        $request->session()->put('user', $user);

        return redirect('profil/tamu')->with('success-foto', 'Berhasil Mengubah Foto');
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
    public function bookingKamar(Request $request)
    {
        $lastBooking = Reservasi::orderBy('created_at', 'desc')->first();

        if ($lastBooking) {
            $lastNumber = (int) substr($lastBooking->no_booking, 0, 2);
            $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '01';
        }

        $currentDate = now();
        $bookingNumber = $newNumber . '/' . $currentDate->format('d/m/Y');

        // save reservasi
        $reservasi = Reservasi::create([
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => 'menunggu pembayaran',
            'no_booking' => $bookingNumber,
            'tipe_kamar_id' => $request->tipe_kamar_id,
            'tamu_id' => session('user')->id,
            'kamar_id' => $request->id_kamar,
        ]);

        $startDate = Carbon::createFromFormat('Y-m-d', $request->checkin);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->checkout);

        $jumlahHari = $endDate->diffInDays($startDate);

        Transaksi::create([
            'tgl_transaksi' => $currentDate,
            'metode_pembayaran' => '-',
            'total_biaya' => $request->total_biaya * $jumlahHari,
            'reservasi_id' => $reservasi->id,
            'tamu_id' => session('user')->id,
            'bukti_pembayaran' => '-',
            'status_pembayaran' => 'menunggu pembayaran'
        ]);

        return redirect('riwayat/tamu')->with([
            'success' => 'Berhasil Booking Kamar, Harap Lakukan Pembayaran'
        ]);
    }
    public function cekKamarTersedia($checkin, $checkout, $tipeKamar)
    {
        // menunggu pembayaran
        // dump($checkin, $checkout, $tipeKamar);
        $reservasi = Reservasi::where('status', 'full')->orWhere('status', 'pending')->orWhere('status', 'menunggu pembayaran')->get();

        $dataTipeKamar = [];
        $dataKamar = [];

        foreach ($reservasi as $reservasi) {
            $cekCheckin = Carbon::createFromFormat('Y-m-d', $checkin);
            $cekCheckout = Carbon::createFromFormat('Y-m-d', $checkout);

            $tanggalAwal = Carbon::createFromFormat('Y-m-d', $reservasi->checkin);
            $tanggalAkhir = Carbon::createFromFormat('Y-m-d', $reservasi->checkout);

            if ($cekCheckin->between($tanggalAwal, $tanggalAkhir)) {
                array_push($dataTipeKamar, $reservasi->tipe_kamar_id);
                array_push($dataKamar, $reservasi->kamar_id);
            }

            if ($cekCheckout->between($tanggalAwal, $tanggalAkhir)) {
                array_push($dataTipeKamar, $reservasi->tipe_kamar_id);
                array_push($dataKamar, $reservasi->kamar_id);
            }
        }

        $tipeKamarDB = TipeKamar::join('kamars', 'kamars.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->where('kamars.tipe_kamar_id', '=', $tipeKamar)
            ->whereNotIn('kamars.id', $dataKamar)
            ->select('tipe_kamars.*', 'kamars.*');

        // dd($dataTipeKamar, $dataKamar, $tipeKamarDB->first()->id);

        return response()->json([
            'jumlah_kamar' => $tipeKamarDB->count(),
            'id_kamar' => $tipeKamarDB->first()->id,
            'nomor_kamar' => $tipeKamarDB->first()->no_kamar,
            'harga' => $tipeKamarDB->first()->harga
        ]);
    }

    public function pembayaran($id)
    {
        $transaksi = Transaksi::findorfail($id);

        $data = [
            'transaksi' => $transaksi
        ];

        return view('tamu/menu/pembayaran', $data);
    }
    public function simpanPembayaran(Request $request, $id)
    {
        $data = [
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'dibayar'
        ];

        $file = $request->file('bukti_pembayaran');
        $filename = date('His') . "." . $file->getClientOriginalExtension();
        $location = 'image/bukti-pembayaran/';
        $filepath = $location . $filename;
        $file->move($location, $filename);
        $data['bukti_pembayaran'] = $filepath;

        Transaksi::where('id', $id)->update($data);

        Reservasi::where('id', $request->reservasi_id)->update([
            'status' => 'menunggu pembayaran',
            'alasan' => ''
        ]);

        return redirect('riwayat/tamu')->with([
            'success' => 'Berhasil Melakukan Pembayaran'
        ]);
    }

    public function riwayat()
    {
        $userID = session('user')->id;

        $riwayat = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->join('kamars', 'reservasis.kamar_id', '=', 'kamars.id')
            ->join('transaksis', 'reservasis.id', '=', 'transaksis.reservasi_id')
            ->select(
                'tipe_kamars.tipe_kamar',
                'tipe_kamars.harga',
                'reservasis.*',
                'kamars.no_kamar',
                'transaksis.status_pembayaran',
                'transaksis.bukti_pembayaran',
                'transaksis.id as transaksi_id',
            )
            ->orderBy('reservasis.no_booking', 'desc')
            ->where('reservasis.tamu_id', $userID)->get();

        $data = [
            'riwayat' => $riwayat
        ];

        return view('tamu/menu/riwayat', $data);
    }

    public function downloadStruk($id)
    {
        $riwayat = Reservasi::join('tipe_kamars', 'reservasis.tipe_kamar_id', '=', 'tipe_kamars.id')
            ->join('kamars', 'reservasis.kamar_id', '=', 'kamars.id')
            ->join('transaksis', 'reservasis.id', '=', 'transaksis.reservasi_id')
            ->join('tamus', 'reservasis.tamu_id', '=', 'tamus.id')
            ->select(
                'tipe_kamars.tipe_kamar',
                'tipe_kamars.harga',
                'reservasis.*',
                'kamars.no_kamar',
                'transaksis.status_pembayaran',
                'transaksis.bukti_pembayaran',
                'transaksis.total_biaya',
                'transaksis.id as transaksi_id',
                'tamus.nama as nama_tamu'
            )
            ->orderBy('reservasis.no_booking', 'desc')
            ->where('transaksis.reservasi_id', $id)
            ->first();

        $data = [
            'riwayat' => $riwayat
        ];

        $pdf = PDF::loadview('tamu.menu.struk', $data);

        // return view('tamu.menu.struk', $data);

        return $pdf->download('struk.pdf');
    }
}
