<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Pastikan relasi 'anak' dimuat dengan benar
        $anak = Auth::user()->anak()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('Dashboard', compact('anak'));
    }
}
