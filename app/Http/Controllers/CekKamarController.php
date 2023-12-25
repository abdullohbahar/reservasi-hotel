<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CekKamarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($checkin, $checkout, $tipeKamar)
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

        // dd($tipeKamar, $dataKamar, $tipeKamarDB->first());

        $startDate = Carbon::createFromFormat('Y-m-d', $checkin);
        $endDate = Carbon::createFromFormat('Y-m-d', $checkout);

        $jumlahHari = $endDate->diffInDays($startDate);

        $harga = $tipeKamarDB->first()->harga ?? '';

        if ($harga) {
            $harga = $tipeKamarDB->first()->harga * $jumlahHari;
        }

        return response()->json([
            'jumlah_kamar' => $tipeKamarDB->count(),
            'id_kamar' => $tipeKamarDB->first()->id ?? '',
            'nomor_kamar' => $tipeKamarDB->first()->no_kamar ?? '',
            'harga' => $harga ?? ''
        ]);
    }
}
