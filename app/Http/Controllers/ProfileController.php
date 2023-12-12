<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::findOrFail(Auth::user()->id);
        return view('profile.index',compact('data'));
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
        $data = User::findOrFail($id);
        if($request->password == null){
            $data->update([
                
                'username' => $request->username,
                'email' => $request->email,
                'name' => $request->name,
            ]);
            if($data)
            {
                return redirect()->route('profile.index')->with('success','Data Berhasil');
            }else{
                return redirect()->route('profile.index')->with('error','Data Gagal Disimpan');
            }
        }else{
            $request->validate([
                'password' => 'required|min:8',
                'confirm' => 'required|same:password',
            ]);
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'Username' => $request->username,
                'password' => bcrypt($request->password),
            ]);
            if($data)
            {
                return redirect()->route('profile.index')->with('success','Data Berhasil');
            }else{
                return redirect()->route('profile.index')->with('error','Data Gagal Disimpan');
            }
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
        //
    }
}
