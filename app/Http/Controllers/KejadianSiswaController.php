<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian_siswa;
use App\Siswa;
use App\Kejadian;
use App\Forum_kejadian;
use App\Notif_bk;
use App\Http\Requests\KejadianSiswaRequest;
use App\Http\Requests\ChatRequest;

use Session;
use Auth;

class KejadianSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
    public function cari(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $query = Kejadian_siswa::whereHas('siswa', function($s) use($kata_kunci) {
            $s->where('nama_siswa', 'LIKE','%'.$kata_kunci.'%');
        });
        $kejadian_siswa_list = $query->orderBy('id','desc')->paginate(5);
        $pagination = $kejadian_siswa_list->appends($request->except('page'));
        $jumlah_kejadian_siswa = $kejadian_siswa_list->total();
        return view('kejadian_siswa.index', compact('kejadian_siswa_list','jumlah_kejadian_siswa','pagination','kata_kunci'));

    }
    public function chatview(Kejadian_siswa $kejadian_siswa)
    {
        $forum_kejadian_list = Forum_kejadian::orderBy('created_at','desc')->get();
        return view('kejadian_siswa.chat', compact('kejadian_siswa','forum_kejadian_list'));
    }
    public function chatsave(ChatRequest $request, Kejadian_siswa $kejadian_siswa)
    {
        $forum_kejadian = new Forum_kejadian;
        $forum_kejadian->id_kejadian_siswa = $kejadian_siswa->id;
        $forum_kejadian->id_user = Auth::user()->id;
        $forum_kejadian->komentar = $request->komentar;
        $forum_kejadian->save();
        $notif_bk = new Notif_bk;
        $forum_kejadian->notif_bk()->save($notif_bk);
        Session::flash('flash_message', 'Data chat berhasil ditambahkan.');
        return redirect('kejadian_siswa/'.$kejadian_siswa->id.'/chatview');
    }
    public function chatdelete(Kejadian_siswa $kejadian_siswa, Forum_kejadian $forum_kejadian)
    {
        $delete = $forum_kejadian->delete();
        $notif_delete = Notif_bk::where('id_forum',$forum_kejadian->id);
        $notif_delete->delete();
        Session::flash('flash_message', 'Data chat berhasil dihapus.');
        return redirect('kejadian_siswa/'.$kejadian_siswa->id.'/chatview');
    }
}
