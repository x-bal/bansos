<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::get();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        $jeni = new Jenis();

        return view('jenis.create', compact('jeni'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            Jenis::create($attr);

            DB::commit();

            return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Jenis $jenis)
    {
        //
    }

    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', compact('jeni'));
    }

    public function update(Request $request, Jenis $jeni)
    {
        $attr = $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            $jeni->update($attr);

            DB::commit();

            return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Jenis $jenis)
    {
        //
    }
}
