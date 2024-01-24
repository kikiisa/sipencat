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
        $valid = Validator::make($request->all(), [
            'satuan' => 'required',
            'volume' => 'required|numeric'
        ],[
            'satuan.required' => 'Satuan harus diisi',
            'volume.required' => 'Volume harus diisi',
            'volume.numeric' => 'Volume harus berupa angka'
        ]);
        if($valid->fails())
        {
            return response()->json([
                'message' => 'error',
                'errors' => $valid->errors()
            ],422);
        }

      
        echo json_encode([
            'data' => [
                'stauan' =>$this->transactionService->removeKoma($request->satuan),
                'volume' => $request->volume
            ],
        ]);
    }
}
