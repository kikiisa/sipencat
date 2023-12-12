<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payTodayUji = Transaksi::whereDate('created_at', today())->where('status','success')->sum('price_uji');
        $payTodayRegis = Transaksi::whereDate('created_at', today())->where('status','success')->sum('price_regis'); 
        $payToday = $payTodayRegis + $payTodayUji;
        $total = Transaksi::all()->where('status','success')->where('status','success')->sum('price_regis') + Transaksi::all()->where('status','success')->where('status','success')->sum('price_uji');
        return view('dashboard.index',[
            'payToday' => $payToday,
            'total' => $total,
            'pending' => Transaksi::all()->where('status','Pending')->count(),
            'success' => Transaksi::all()->where('status','Success')->count(),
            'failed' => Transaksi::all()->where('status','Failed')->count(),
        ]);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
