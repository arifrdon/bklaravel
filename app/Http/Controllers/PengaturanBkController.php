<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaturan_bk;
use Session;
use App\Http\Requests\PengaturanBkRequest;

class PengaturanBkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function edit_pengaturan()
    {
        return view('pengaturan_bk.edit');
    }
    public function update_pengaturan(PengaturanBkRequest $request)
    {

        Pengaturan_bk::where('id',1)->update(['nilai_pengaturan'=> $request->poin_awal]);
        Pengaturan_bk::where('id',2)->update(['nilai_pengaturan'=> $request->fitur_reward]);
        Pengaturan_bk::where('id',3)->update(['nilai_pengaturan'=> $request->operator_bk]);
        Session::flash('flash_message', 'Data pengaturan berhasil diupdate.');
        return redirect('pengaturan_bk');
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
