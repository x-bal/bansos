<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Rfid;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::where('is_active', 1)->get();
        $jenis = Jenis::get();

        return view('warga.index', compact('warga', 'jenis'));
    }

    public function create()
    {
        $warga = new Warga();

        return view('warga.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nik' => 'required|unique:wargas',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'status_perkawinan' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg',
        ]);

        try {
            DB::beginTransaction();

            $photo = $request->file('foto');
            $attr['foto'] = $photo->storeAs('images/warga', Str::slug($request->nama) . '-' . date('YmdHis') . $photo->extension());

            Warga::create($attr);

            DB::commit();

            return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Warga $warga)
    {
        $jenis = Jenis::get();

        return view('warga.show', compact('warga', 'jenis'));
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $attr = $request->validate([
            'nik' => 'required|unique:wargas,nik,' . $warga->id,
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'status_perkawinan' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'mimes:jpg,png,jpeg',
        ]);

        try {
            DB::beginTransaction();

            if ($request->file('foto')) {
                $photo = $request->file('foto');
                Storage::delete($warga->foto);
                $attr['foto'] = $photo->storeAs('images/warga', Str::slug($request->nama) . '-' . date('YmdHis') . '.' . $photo->getExtension());
            } else {
                $attr['foto'] = $warga->foto;
            }

            if ($request->rfid) {
                $rfid = Rfid::where('rfid', $request->rfid)->first();
                $rfid->update(['status' => 0]);
                $attr['rfid'] = $request->rfid;
            }

            $warga->update($attr);

            DB::commit();

            return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Warga $warga)
    {
        //
    }

    public function get_warga()
    {
        $warga = Warga::where('is_active', 1)->get();

        return response()->json(['warga' => $warga], 200);
    }

    public function store_jenis(Request $request)
    {
        $request->validate(['jenis' => 'required', 'id' => 'required']);

        try {
            DB::beginTransaction();

            foreach ($request->id as $id) {
                $warga = Warga::find($id);
                $warga->jenis()->sync($request->jenis);
            }

            DB::commit();

            return redirect()->route('warga.index')->with('success', 'Data penerima bantuan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update_bantuan(Request $request, Warga $warga)
    {
        try {
            DB::beginTransaction();

            $warga->jenis()->sync($request->jenis);

            DB::commit();

            return back()->with('success', 'Daftar bantuan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
