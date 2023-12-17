<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Resepsionis;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user/menu/login');
    }
    public function aksilogin(Request $request)
    {
        $userLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $email = $request->input('email');

        $resepsionis = Resepsionis::where('email', $email)->first();

        if ($resepsionis && Hash::check($request->password, $resepsionis->password)) {
            // aksi login dan redirect ke halaman resepsionis
            $request->session()->regenerate();

            $request->session()->put("role", 'Resepsionis');

            $request->session()->put('user', $resepsionis);

            return redirect('dashboard/resepsionis');
        }

        $user = Tamu::where('email', $email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // aksi login dan redirect ke halaman user
            $request->session()->regenerate();

            $request->session()->put("role", 'Tamu');

            $request->session()->put('user', $user);


            return redirect('dashboard/tamu');
        }

        $admin = Admin::where('email', $email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            // aksi login dan redirect ke halaman user
            $request->session()->regenerate();

            $request->session()->put("role", 'Admin');

            $request->session()->put('user', $user);


            return redirect('dashboard/admin');
        }


        return redirect('login/user')->with('error', '');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login/user')->with('success', 'Logout Successfully');
    }

    public function daftaruserview()
    {
        return view('user/menu/daftar');
    }
    public function lupapasswordview()
    {
        return view('user/menu/lupapassword');
    }

    public function userstore(Request $request)
    {
        $data = [
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'no_wa' => $request->input('no_wa'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'password' => Hash::make($request->input('password')),
            'gambar' => 'Profil.jpeg'
        ];

        Tamu::create($data);
        return redirect('login/user')->with('success', '');
    }
}
