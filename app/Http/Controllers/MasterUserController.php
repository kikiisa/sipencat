<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('user.index',compact('data'));
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
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm' => 'required|same:password',
        ],[
            'password.min' => 'Password minimal 8 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'username.unique' => 'Username sudah terdaftar',
            'confirm.same' => 'Konfirmasi password tidak sama dengan password',
            'confirm.required' => 'Konfirmasi password tidak boleh kosong',
        ]);

        $data = User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'status' => 'active',
            'password' => bcrypt($request->password),
        ]);
        if($data){
            return redirect()->route('master-user.index')->with('success','Data user berhasil ditambahkan');    
        }else{
            return redirect()->route('master-user.index')->with('error','Data user gagal ditambahkan');
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
        $data = User::all()->where('uuid',$id)->first();
        return view('user.edit',compact('data'));
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
                'status' => $request->status,
            ]);
            if($data)
            {
                return redirect()->route('master-user.index')->with('success','Data Berhasil');
            }else{
                return redirect()->route('master-user.index')->with('error','Data Gagal Disimpan');
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
                'status' => $request->status,
            ]);
            if($data)
            {
                return redirect()->route('master-user.index')->with('success','Data Berhasil');
            }else{
                return redirect()->route('master-user.index')->with('error','Data Gagal Disimpan');
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
        $data = User::findOrFail($id);
        $data->delete();
        if($data)
        {
            return redirect()->route('master-user.index')->with('success','Data Berhasil Di Hapus');
        }else{
            return redirect()->route('master-user.index')->with('error','Data Gagal Di Hapus');
        }
    }
}
