<?php

namespace App\Http\Controllers;

use App\Http\Service\ServiceTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

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
        // BIAYA REGIS 1
        $totalBiayaRegis1 = $volume1 * $regisKendaraanBaru["jbb1"];

        // BIAYA UJI 1
        $totalBiaya1 = $volume1 * $biayaUji["jbb1"];
        // TOTAL 1
        $total1 = $totalBiayaRegis1 + $totalBiaya1;
        // -------------------------------------------
        
        $satuan2 = $request->price2["satuan"];
        $volume2 = $request->price2["volume"];
        $totalBiayaRegis2 = $volume2 * $regisKendaraanBaru["jbb2"];
        $totalBiaya2 = $volume2 * $biayaUji["jbb2"];
        $total2 = $totalBiayaRegis2 + $totalBiaya2;
       
        $bukuUji = ($volume1 + $volume2) * 35000;
        $grandTotal = $total1 + $total2 + $bukuUji;
        return response()->json([
            "satuan1" => $volume1,
            "satuan2" => $volume2,
            "totalBukuUji" => $volume1 + $volume2,
            "finalTotal" => $grandTotal
        ]);

        // try{
        //     DB::beginTransaction();
        //     Transaksi::created([
                
        //         'satuan1' => $satuan1,
        //         'biayaRegis1' => $totalBiayaRegis1,
        //         'biayaUji1' => $totalBiaya1,
        //         'VolumeKendaraanBaru1' => $volume1,
        //         'satuan2' => $satuan2,
        //         'biayaRegis2' => $totalBiayaRegis2,
        //         'biayaUji2' => $totalBiaya2,
        //         'VolumeKendaraanBaru2' => $volume2
        //     ]);
        //     return response()->json([
        //         'total1' => [
        //             "regis" => $totalBiayaRegis1,
        //             "uji" => $totalBiaya1,
        //             "total" => $total1
        //         ],
        //         'total2' => [
        //             "regis" => $totalBiayaRegis2,
        //             "uji" => $totalBiaya2,
        //             "total" => $total2
        //         ],
        //         'totalBukuUji' => $volume1 + $volume2,
        //         'buku_uji' => $bukuUji,
        //         'finalTotal' => $total1 + $total2 + $bukuUji
        //     ]);
        //     DB::commit();
        // }catch(Exception $e){
        //     DB::rollBack();
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ], 500);
        // }
    }
}
