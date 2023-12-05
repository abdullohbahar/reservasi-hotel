<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Resepsionis;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard Admin :
    public function index()
    {
        return view('admin/menu/dashboard');
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
        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_wa' => $request->input('no_wa'),
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
        return view('admin/menu/laporan/absen');
    }
    public function pendapatanview()
    {
        return view('admin/menu/laporan/pendapatan');
    }
}
