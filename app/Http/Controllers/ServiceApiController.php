<?php

namespace App\Http\Controllers;

use App\Http\Service\ServiceTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceApiController extends Controller
{
    private $transactionService;
    public function __construct()
    {
        $this->transactionService = new ServiceTransaksi();
    }
    public function transaction(Request $request)
    {
        
        $regisKendaraanBaru = [
            'jbb1' => 350000,
            'jbb2' => 750000
        ];

        $biayaUji = [
            'jbb1' => 150000,
            'jbb2' => 250000
        ];


        $satuan1 = $request->price1["satuan"];
        $volume1 = $request->price1["volume"];
        $total1 = ($volume1 * $biayaUji["jbb1"]);
        $grandTotal1 = $total1 == 0 ? 0 : $total1 + $regisKendaraanBaru["jbb1"];

        $satuan2 = $request->price2["satuan"];
        $volume2 = $request->price2["volume"];
        $total2 =  ($volume2 * $biayaUji["jbb2"]);
        
        $bukuUji = $request->uji * 35000;

        $grandTotal2 = $total2 == 0 ? 0 : $total2 + $regisKendaraanBaru["jbb2"];
        $finalTotal = $grandTotal1 + $grandTotal2;
        return response()->json([
            'temp1' => $grandTotal1,
            'temp2' => $grandTotal2,
            'final' => $bukuUji + $finalTotal, 
        ]);
    }
}
