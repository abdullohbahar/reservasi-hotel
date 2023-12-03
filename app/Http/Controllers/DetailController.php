<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DetailController extends Controller
{
    public function detailkamar($id)
    {
        $tipekamar = TipeKamar::all();
        $detail = TipeKamar::where('id', $id)->first();
        $data = [
            'tipe_kamar' => $detail,
            'tipekamar' => $tipekamar,
        ];
        return view('detail/kamar', $data);
    }
    public function detailtamu()
    {
        return view('detail/tamu');
    }
}
