<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    /**
     * Mendapatkan data jumlah anak per user untuk ditampilkan dalam grafik
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnakPerUserData()
    {
        // Mengambil data jumlah anak per user
        $data = User::select('users.name', DB::raw('COUNT(anak.id) as jumlah_anak'))
            ->leftJoin('anak', 'users.id', '=', 'anak.user_id')
            ->groupBy('users.id', 'users.name')
            ->having(DB::raw('COUNT(anak.id)'), '>', 0) // Hanya user yang memiliki anak
            ->orderBy('jumlah_anak', 'desc')
            ->limit(10) // Batasi 10 user teratas
            ->get();

        return response()->json($data);
    }

    /**
     * Mendapatkan total data anak
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalAnak()
    {
        $totalAnak = Anak::count();
        return response()->json(['total' => $totalAnak]);
    }
}