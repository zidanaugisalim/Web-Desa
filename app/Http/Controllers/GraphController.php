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
     * Hanya menampilkan anak aktif yang berumur di bawah 5 tahun
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnakPerUserData()
    {
        // Mengambil data jumlah anak per user (hanya anak aktif di bawah 5 tahun)
        $data = User::select('users.name', DB::raw('COUNT(anak.id) as jumlah_anak'))
            ->leftJoin('anak', function($join) {
                $join->on('users.id', '=', 'anak.user_id')
                     ->where('anak.is_archived', false)
                     ->whereRaw('TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) < 5');
            })
            ->groupBy('users.id', 'users.name')
            ->having(DB::raw('COUNT(anak.id)'), '>', 0) // Hanya user yang memiliki anak
            ->orderBy('jumlah_anak', 'desc')
            ->limit(10) // Batasi 10 user teratas
            ->get();

        return response()->json($data);
    }

    /**
     * Mendapatkan total data anak aktif yang berumur di bawah 5 tahun
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalAnak()
    {
        $totalAnak = Anak::where('is_archived', false)
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 5')
            ->count();
        return response()->json(['total' => $totalAnak]);
    }
}