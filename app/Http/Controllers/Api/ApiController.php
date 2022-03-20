<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Rfid;
use App\Models\SecretKey;
use App\Models\WaktuOperasional;
use App\Models\Warga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMode(Request $request)
    {
        if ($request->key && $request->iddev) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $device = Device::find($request->iddev);

                if ($device) {
                    echo '*' . $device->mode . '*';
                } else {
                    echo "*Device Tidak Ditemukan*";
                }
            } else {
                echo "*Salah Secret Key*";
            }
        } else {
            echo "*Salah Param*";
        }
    }

    public function getModeJson(Request $request)
    {
        if ($request->key && $request->iddev) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $device = Device::find($request->iddev);

                if ($device) {
                    $response = [
                        'status' => 'success',
                        'mode' => $device->mode,
                        'ket' => 'Berhasil'
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        'status' => 'warning',
                        'mode' => '-',
                        'ket' => 'Device tidak ditemukan'
                    ];
                    echo json_encode($response);
                }
            } else {
                $response = [
                    'status' => 'failed',
                    'ket' => 'Salah Secret Key'
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 'failed',
                'ket' => 'Salah Parameter'
            ];
            echo json_encode($response);
        }
    }

    public function addCard(Request $request)
    {
        if ($request->key && $request->iddev && $request->rfid) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $checkRfid = Rfid::where('rfid', $request->rfid)->first();

                if ($checkRfid) {
                    echo "*Rfid Sudah Terdaftar*";
                } else {
                    $device = Device::find($request->iddev);

                    if ($device) {
                        $rfid = Rfid::find(1);

                        $newRfid = $rfid->update([
                            'device_id' => $device->id,
                            'rfid' => $request->rfid
                        ]);

                        if ($newRfid) {
                            echo "*Rfid berhasil ditambahkan*";
                        } else {
                            echo "*Terjadi Kesalahan*";
                        }
                    } else {
                        echo "*Device Tidak Ditemukan*";
                    }
                }
            } else {
                echo "*Salah Secret Key*";
            }
        } else {
            echo "*Salah Param*";
        }
    }

    public function addCardJson(Request $request)
    {
        if ($request->key && $request->iddev && $request->rfid) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $checkRfid = Rfid::where('rfid', $request->rfid)->first();

                if ($checkRfid) {
                    $response = [
                        'status' => 'failed',
                        'ket' => 'RFID sudah terdaftar'
                    ];
                    echo json_encode($response);
                } else {
                    $device = Device::find($request->iddev);

                    if ($device) {
                        $rfid = Rfid::find(1);

                        $newRfid = $rfid->update([
                            'device_id' => $device->id,
                            'rfid' => $request->rfid,
                            'status' => 1
                        ]);

                        if ($newRfid) {
                            $response = [
                                'status' => 'success',
                                'ket' => 'Rfid berhasil ditambahkan'
                            ];
                            echo json_encode($response);
                        } else {
                            $response = [
                                'status' => 'failed',
                                'ket' => 'Terjadi Kesalahan'
                            ];
                            echo json_encode($response);
                        }
                    } else {
                        $response = [
                            'status' => 'failed',
                            'ket' => 'Device tidak ditemukan'
                        ];
                        echo json_encode($response);
                    }
                }
            } else {
                $response = [
                    'status' => 'failed',
                    'ket' => 'Salah Secret Key'
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 'failed',
                'ket' => 'Salah Param'
            ];
            echo json_encode($response);
        }
    }

    public function absensi(Request $request)
    {
        if ($request->key && $request->iddev && $request->rfid) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $device = Device::find($request->iddev);
                $rfid = Warga::where('rfid', $request->rfid)->first();

                if ($rfid) {
                    $waktu = WaktuOperasional::find(1);

                    $startMasuk = Carbon::parse($waktu->start)->format('His');
                    $endKeluar = Carbon::parse($waktu->end)->format('His');

                    $absen = false;
                    $now = Carbon::now()->format('His');
                    $jadwal = Jadwal::where('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->first();

                    if ($jadwal) {
                        if ($now < $startMasuk) {
                            echo "*Access Diluar Waktu*";
                        }

                        if ($now >= $startMasuk && $now <= $endKeluar) {
                            $absen = true;
                            $ket = "Hadir";
                            $status = 1;
                            $respon = "*Hadir*";
                        }

                        if ($now >= $endKeluar) {
                            echo "*Access Diluar Waktu*";
                        }

                        if ($absen == true) {
                            $today = Carbon::now()->format('Y-m-d');
                            $tomorrow = Carbon::tomorrow()->format('Y-m-d');

                            $kehadiran = Kehadiran::where('warga_id', $rfid->id)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->first();

                            if (!$kehadiran) {
                                try {
                                    Kehadiran::create([
                                        'device_id' => $device->id,
                                        'warga_id' => $rfid->id,
                                        'status' => 1,
                                        'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s'),
                                        'ket' => $ket
                                    ]);

                                    // History::create([
                                    //     'device_id' => $device->id,
                                    //     'rfid' => $rfid->rfid,
                                    //     'keterangan' => $ket
                                    // ]);

                                    echo $respon;
                                } catch (\Throwable $th) {
                                    echo "*Gagal Insert Kehadiran*";
                                }
                            } else if ($kehadiran && $kehadiran->status == 1) {
                                echo "*Sudah Hadir*";
                            } else {
                                echo "*Sudah Hadir*";
                            }
                        } else {
                            echo "*Error Waktu Operasional*";
                        }
                    } else {
                        echo "*Tidak Ada Jadwal Hari Ini*";
                    }
                } else {
                    echo "*Rfid Tidak Ditemukan*";
                }
            } else {
                echo "*Salah Secret Key*";
            }
        } else {
            echo "*Salah Param*";
        }
    }

    public function absensiJson(Request $request)
    {
        if ($request->key && $request->iddev && $request->rfid) {
            $cekKey = SecretKey::find(1);

            if ($cekKey->key == $request->key) {
                $device = Device::find($request->iddev);
                $rfid = Warga::where('rfid', $request->rfid)->first();

                if ($rfid) {
                    $waktu = WaktuOperasional::find(1);

                    $startMasuk = Carbon::parse($waktu->start)->format('His');
                    $endKeluar = Carbon::parse($waktu->end)->format('His');

                    $absen = false;
                    $now = Carbon::now()->format('His');
                    $jadwal = Jadwal::where('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->first();

                    if ($jadwal) {
                        if ($now < $startMasuk) {
                            $response = [
                                'status' => 'failed',
                                'ket' => 'Absensi Diluar Waktu'
                            ];
                            echo json_encode($response);
                        }

                        if ($now >= $startMasuk && $now <= $endKeluar) {
                            $absen = true;
                            $ket = "Hadir";
                            $status = 1;
                            $respon = $rfid->nama . " Hadir";
                        }

                        if ($now >= $endKeluar) {
                            $response = [
                                'status' => 'failed',
                                'ket' => 'Absensi Diluar Waktu'
                            ];
                            echo json_encode($response);
                        }

                        if ($absen == true) {
                            $today = Carbon::now()->format('Y-m-d');
                            $tomorrow = Carbon::tomorrow()->format('Y-m-d');

                            $kehadiran = Kehadiran::where('warga_id', $rfid->id)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->first();

                            if (!$kehadiran) {
                                try {
                                    Kehadiran::create([
                                        'device_id' => $device->id,
                                        'warga_id' => $rfid->id,
                                        'jenis_id' => $jadwal->jenis_id,
                                        'status' => 1,
                                        'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s'),
                                        'ket' => $ket
                                    ]);

                                    // History::create([
                                    //     'device_id' => $device->id,
                                    //     'rfid' => $rfid->rfid,
                                    //     'keterangan' => $ket
                                    // ]);

                                    $response = [
                                        'status' => 'success',
                                        'ket' => $respon,
                                        'nama' => $rfid->nama,
                                        'waktu' => date('d/m/Y H:i:s'),
                                        'absensi' => 'Hadir'
                                    ];
                                    echo json_encode($response);
                                } catch (\Throwable $th) {
                                    $response = [
                                        'status' => 'failed',
                                        'ket' => 'Gagal Insert Kehadiran'
                                    ];
                                    echo json_encode($response);
                                }
                            } else if ($kehadiran && $kehadiran->status == 1) {
                                $response = [
                                    'status' => 'failed',
                                    'ket' => 'Sudah Hadir'
                                ];
                                echo json_encode($response);
                            } else {
                                $response = [
                                    'status' => 'failed',
                                    'ket' => 'Sudah Hadir'
                                ];
                                echo json_encode($response);
                            }
                        } else {
                            $notif = array('status' => 'failed', 'ket' => 'Error Waktu Operasional');
                            echo json_encode($notif);
                        }
                    } else {
                        $notif = array('status' => 'failed', 'ket' => 'Tidak Ada Jadwal Hari Ini');
                        echo json_encode($notif);
                    }
                } else {
                    $notif = array('status' => 'failed', 'ket' => 'RFID Tidak Ditemukan');
                    echo json_encode($notif);
                }
            } else {
                $notif = array('status' => 'failed', 'ket' => 'Salah Secret Key');
                echo json_encode($notif);
            }
        } else {
            $notif = array('status' => 'failed', 'ket' => 'Salah Parameter');
            echo json_encode($notif);
        }
    }
}
