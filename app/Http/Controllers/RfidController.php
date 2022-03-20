<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function __invoke(Request $request)
    {
        $rfid = Rfid::where('id', 1)->where('status', 1)->first();

        return response()->json([
            'rfid' => $rfid
        ]);
    }
}
