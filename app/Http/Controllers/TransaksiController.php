<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class TransaksiController extends Controller
{
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
        $request->validate([
            'name_transaksi' => 'required',
            'qty' => 'required|integer',
            'satuan' => 'required',
            'regis' => 'required',
            'uji' => 'required',
            'status' => 'required',
        ],[
            'name_transaksi.required' => 'Nama transaksi tidak boleh kosong',
            'qty.required' => 'Qty tidak boleh kosong',
            'qty.integer' => 'Qty harus berupa angka',
            'satuan.required' => 'Satuan tidak boleh kosong',
            'regis.required' => 'Harga registrasi tidak boleh kosong',
            'uji.required' => 'Harga uji tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ]);
        $data = Transaksi::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name_transaksi' => $request->name_transaksi,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'price_regis' => $request->regis,
            'price_uji' => $request->uji,
            'status' => $request->status, 
        ]);
        if($data)
        {
            return redirect()->route('transaksi.index')->with('success','Data Berhasil');
        }else{
            return redirect()->route('transaksi.index')->with('error','Data Gagal Disimpan');
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
        //
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
        $request->validate([
            'name_transaksi' => 'required',
            'qty' => 'required|integer',
            'satuan' => 'required',
            'regis' => 'required',
            'uji' => 'required',
            'status' => 'required',
        ],[
            'name_transaksi.required' => 'Nama transaksi tidak boleh kosong',
            'qty.required' => 'Qty tidak boleh kosong',
            'qty.integer' => 'Qty harus berupa angka',
            'satuan.required' => 'Satuan tidak boleh kosong',
            'regis.required' => 'Harga registrasi tidak boleh kosong',
            'uji.required' => 'Harga uji tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ]);
        $data = Transaksi::find($id);
        $data->update([
            'name_transaksi' => $request->name_transaksi,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'price_regis' => $request->regis,
            'price_uji' => $request->uji,
            'status' => $request->status, 
        ]);   
        if($data)
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
