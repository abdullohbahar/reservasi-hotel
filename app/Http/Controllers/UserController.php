<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\User;
use App\Models\Admin;
use App\Models\Resepsionis;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
    public function userstore(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:tamus,nik|unique:resepsionis,nik',
            'nama' => 'required',
            'no_wa' => 'required|unique:tamus,no_wa|unique:resepsionis,no_wa',
            'email' => 'required|unique:tamus,email|unique:resepsionis,email|unique:admins,email',
            'password' => 'required'
        ]);

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

    public function lupapasswordview()
    {
        return view('user/menu/lupapassword');
    }
    public function kirimemail(Request $request)
    {
        $tamu = Tamu::where('email', $request->email)->first();

        if (!$tamu) {
            return redirect()->back()->with('failed', 'Email Tidak Ditemukan');
        }

        $hashEmail = Hash::make($request->email);

        $tamu->forgot_password_token = $hashEmail;
        $tamu->save();

        $data = [
            'name' => $tamu->nama,
            'body' => 'Klik Link Berikut Jika Ingin Merubah Password http://127.0.0.1:8000/reset-password/?token=' . $hashEmail
        ];

        Mail::to($request->email)->send(new ForgotPasswordMail($data));

        return redirect()->back()->with('success', 'Cek Email Untuk Melakukan Reset Password');
    }
    public function resetpasswordview(Request $request)
    {
        $token = $request->token;

        if (!$token) {
            return redirect('lupapassword/user')->with('failed', 'Ulangi Reset Password');
        }

        $data = [
            'token' => $token
        ];

        return view('user.menu.resetpassword', $data);
    }
    public function aksiresetpassword(Request $request)
    {
        $token = $request->token;

        $tamu = Tamu::where('forgot_password_token', $token)->first();

        if (!$tamu) {
            return redirect('lupapassword/user')->with('failed', 'Ulangi Reset Password');
        }

        $tamu->password = Hash::make($request->password);
        $tamu->save();

        return redirect('login/user')->with('success', 'Cek Email Untuk Melakukan Reset Password');
    }
}
