<?php

namespace App\Http\Controllers;

use App\Models\SecretKey;
use App\Models\WaktuOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function setting()
    {
        $waktu = WaktuOperasional::find(1);
        $secretKey = SecretKey::find(1);

        return view('dashboard.setting', compact('waktu', 'secretKey'));
    }

    public function update_setting(Request $request)
    {
        DB::beginTransaction();

        $waktu = WaktuOperasional::find(1);
        $waktu->update([
            'start' => $request->waktu_mulai,
            'end' => $request->waktu_selesai,
        ]);

        DB::commit();

        return back()->with('success', 'Waktu Operasional berhasil diupdate');
    }
}
