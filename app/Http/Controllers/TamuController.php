<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

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
    public function pembayaran()
    {
        return view('tamu/menu/pembayaran');
    }
}
