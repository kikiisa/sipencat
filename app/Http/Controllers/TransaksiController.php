<?php

namespace App\Http\Controllers;

use App\Http\Service\ServiceTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
class TransaksiController extends Controller
{   
    private $service;
    public function __construct()
    {
        $this->service = new ServiceTransaksi();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('from') && $request->get('to')){
            $data = Transaksi::whereBetween('created_at',[$request->get('from'),$request->get('to')])->get();
        }else{
            $data = Transaksi::all();
        }
        if($request->has('cetak'))
        {
            return view('transaksi.report',compact('data')); 
       
        }
        return view('transaksi.index',compact('data'));
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
        if(ServiceTransaksi::insertTransaksi($request)){
            return redirect()->back()->with("success","Berhasil");
        }else{
            return redirect()->back()->with("error","Gagal");
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function cetak(Request $request,$id)
    {
        $data = Transaksi::all()->where("uuid",$id);
        if($data->count() > 0)
        {
            
            $terbilang = $this->service->terbilang($this->service->getTotal($data->first()));
            return response()->view("transaksi.singleReport",[
                'data' => $data->first(),
                'terbilang' => $terbilang,
            ]);
        }else{
            return redirect()->back()->with("error","Data Tidak Ditemukan");
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaksi::all()->where('uuid',$id)->first();
        return view('transaksi.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Transaksi::find($id);
         
        if($this->service->updateTransaksi($request,$data))
        {
            return redirect()->route('transaksi.index')->with('success','Data Berhasil');
        }else{
            return redirect()->route('transaksi.index')->with('error','Data Gagal Disimpan');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Transaksi::find($id);
        $data->delete();
        if($data)
        {
            return redirect()->route('transaksi.index')->with('success','Data Berhasil');
        }else{
            return redirect()->route('transaksi.index')->with('error','Data Gagal Dihapus');
        }
    }
}
