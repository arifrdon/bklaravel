<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian_siswa;
use App\Siswa;
use App\Kejadian;
use App\Http\Requests\KejadianSiswaRequest;

use Session;

class KejadianSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadian_siswa_list = Kejadian_siswa::orderBy('id','desc')
        ->Paginate(5);
        $jumlah_kejadian_siswa = Kejadian_siswa::count();

        return view('kejadian_siswa.index', compact('kejadian_siswa_list','jumlah_kejadian_siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa_list = Siswa::pluck('nama_siswa', 'id');
        $kejadian_list = Kejadian::pluck('nama_kejadian', 'id');
        // $siswa2list = Siswa::select('nama_siswa','nisn','id')->get();
        // foreach ($siswa2list as $me){
        //     echo $me->nisn;
        // }
        // print_r(  $siswa2list = Siswa::all()->only('nisn')->all());
        // foreach ($siswa2list as $me){
        //     echo $me->nisn;
        // }

        // $collection = collect(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

        // $filtered = $collection->only(['product_id', 'name']);

        // $sw = Siswa::all();
        // foreach ($sw as $key) {
        //     echo $key;
        // };
        return view ('kejadian_siswa.create', compact('siswa_list','kejadian_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KejadianSiswaRequest $request)
    {
        $input  = $request->all();
        $kejadian_siswa = Kejadian_siswa::create($input + ["tanggaljam_kejadian" => $input["tanggal_kejadian"]." ".$input["jam_kejadian"].":00"]);
        Session::flash('flash_message', 'Data kejadian siswa berhasil disimpan.');
        return redirect('kejadian_siswa');

        //print_r($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kejadian_siswa $kejadian_siswa)
    {
        return view('kejadian_siswa.show', compact('kejadian_siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kejadian_siswa $kejadian_siswa)
    {
        $siswa_list = Siswa::pluck('nama_siswa', 'id');
        $kejadian_list = Kejadian::pluck('nama_kejadian', 'id');
        return view('kejadian_siswa.edit', compact('kejadian_siswa','siswa_list','kejadian_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KejadianSiswaRequest $request, Kejadian_siswa $kejadian_siswa)
    {
        $input  = $request->all();
        $kejadian_siswa->update($input + ["tanggaljam_kejadian" => $input["tanggal_kejadian"]." ".$input["jam_kejadian"].":00"]);
        Session::flash('flash_message', 'Data kejadian siswa berhasil diupdate.');
        return redirect('kejadian_siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kejadian_siswa $kejadian_siswa)
    {
        $kejadian_siswa->delete();
        Session::flash('flash_message', 'Data kejadian siswa berhasil dihapus.');
        return redirect('kejadian_siswa');
    }
}
