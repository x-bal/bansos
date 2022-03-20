<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index()
    {
        $device = Device::get();

        return view('device.index', compact('device'));
    }

    public function create()
    {
        $device = new Device();

        return view('device.create', compact('device'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            Device::create(['name' => $request->nama]);

            DB::commit();
            return redirect()->route('device.index')->with('success', 'Device berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Device $device)
    {
        try {
            DB::beginTransaction();

            $device->update(['mode' => request('mode')]);

            DB::commit();

            return response()->json([
                'message' => 'Mode berhasil diubah',
                'device' => $device
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Mode gagal diubah'
            ]);
        }
    }

    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            $device->update(['name' => $request->nama]);

            DB::commit();
            return redirect()->route('device.index')->with('success', 'Device berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Device $device)
    {
        //
    }
}
