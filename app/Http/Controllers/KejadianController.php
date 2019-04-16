<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian;
use App\Kelassw;
use App\Siswa;
use App\Http\Requests\KejadianRequest;
use Session;

class KejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadian_list = Kejadian::orderBy('nama_kejadian','asc')
        ->Paginate(5);
        $jumlah_kejadian = Kejadian::count();

        $siswa_list = Siswa::all();

        return view('kejadian.index', compact('kejadian_list','jumlah_kejadian','siswa_list'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('kejadian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KejadianRequest $request)
    {
        //
        $input = $request->all();
        $kejadian = Kejadian::create($input);
        Session::flash('flash_message', 'Data kejadian berhasil disimpan.');
        return redirect('kejadian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kejadian $kejadian)
    {
        return view('kejadian.show', compact('kejadian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kejadian $kejadian)
    {
        return view('kejadian.edit', compact('kejadian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KejadianRequest $request, Kejadian $kejadian)
    {
        $input=$request->all();
        $kejadian->update($input);
        Session::flash('flash_message', 'Data kejadian berhasil diupdate.');
        return redirect('kejadian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kejadian $kejadian)
    {
        $kejadian->delete();
        Session::flash('flash_message', 'Data kejadian berhasil dihapus.');
        return redirect('kejadian');
    }
}
