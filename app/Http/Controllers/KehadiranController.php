<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kehadiran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        $jenis = Jenis::get();

        if (request('mulai') && request('sampai') && request('jenis')) {
            $mulai = Carbon::parse(request('mulai'))->format('Y-m-d 00:00:00');
            $sampai = Carbon::parse(request('sampai'))->addDay(1)->format('Y-m-d 00:00:00');

            if (request('jenis') == 'semua') {
                $kehadiran = Kehadiran::whereBetween('created_at', [$mulai, $sampai])->get();
            } else {
                $kehadiran = Kehadiran::whereBetween('created_at', [$mulai, $sampai])->where('jenis_id', request('jenis'))->get();
            }
        } else {
            $now = Carbon::now('Asia/Jakarta')->format('Y-m-d 00:00:00');
            $tomorrow = Carbon::tomorrow('Asia/Jakarta')->format('Y-m-d 00:00:00');

            $kehadiran = Kehadiran::whereBetween('created_at', [$now, $tomorrow])->get();
        }


        return view('kehadiran.index', compact('kehadiran', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kehadiran $kehadiran)
    {
        //
    }
}
