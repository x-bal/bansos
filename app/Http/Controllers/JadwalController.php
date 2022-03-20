<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::get();

        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $jenis = Jenis::get();
        $jadwal = new Jadwal();

        return view('jadwal.create', compact('jenis', 'jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'tanggal' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Jadwal::updateOrCreate(
                [
                    'jenis_id' => $request->jenis
                ],
                ['tanggal' => $request->tanggal]
            );

            DB::commit();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal bantuan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $jenis = Jenis::get();

        return view('jadwal.edit', compact('jenis', 'jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'jenis' => 'required',
            'tanggal' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Jadwal::updateOrCreate(
                [
                    'jenis_id' => $request->jenis
                ],
                ['tanggal' => $request->tanggal]
            );

            DB::commit();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal bantuan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
