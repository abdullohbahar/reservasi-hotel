<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TamuDefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('role') == 'Admin') {
                return redirect('dashboard/admin');
            } else if (session('role') == 'Resepsionis') {
                return redirect('dashboard/resepsionis');
            } else if (session('role') == 'Tamu') {
                return redirect('dashboard/tamu');
            } else {
                return $next($request);
            }
        });
    }

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
}
