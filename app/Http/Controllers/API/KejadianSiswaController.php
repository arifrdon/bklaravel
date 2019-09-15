<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KejadianSiswaRequest;
use App\Http\Requests\ChatRequest;
use Auth;
use App\Kejadian_siswa;
use App\Forum_kejadian;
use App\Notif_bk;

class KejadianSiswaController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == "guru")
        {
            $guruid = Auth::user()->id;
            $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                $s->whereHas('kelassw', function($k) use($guruid) {
                    $k->where('id_wali_kelas', $guruid);
                });
            });
        } 
        elseif (Auth::user()->level == "orang_tua") {
            $ortuid = Auth::user()->id;
            $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                $s->where('id_ortu', $ortuid);
            });
        }
        else 
        {
            $queryguruorortu = Kejadian_siswa::orderBy('id','desc');
        }

        $kejadian_siswa_list = $queryguruorortu->with(['kejadian','siswa'])
        ->get();
        $jumlah_kejadian_siswa = $queryguruorortu->count();
        $data = $kejadian_siswa_list->toArray();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah_kejadian_siswa' => $jumlah_kejadian_siswa
        ];

        return response()->json($response, 200);
    }
    public function store(KejadianSiswaRequest $request)
    {
        $input  = $request->all();
        $kejadian_siswa = Kejadian_siswa::create($input + ["tanggaljam_kejadian" => $input["tanggal_kejadian"]." ".$input["jam_kejadian"].":00"]);

        $response = [
            'success' => 'success',
            'message' => 'Data kejadian siswa berhasil disimpan.'
        ];
        return response()->json($response, 200);

    }
    public function show($id)
    {
        $data = Kejadian_siswa::where('id', $id);
        $data = $data->with(['kejadian','siswa'])->get();
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian siswa retrieved successfully.'
        ];
        return response()->json($response, 200);
    }
    public function update(KejadianSiswaRequest $request, Kejadian_siswa $kejadian_siswa)
    {
        $input  = $request->all();
        $kejadian_siswa->update($input + ["tanggaljam_kejadian" => $input["tanggal_kejadian"]." ".$input["jam_kejadian"].":00"]);
        $response = [
            'success' => 'success',
            'message' => 'Data kejadian siswa berhasil diupdate.'
        ];
        return response()->json($response, 200);
    }
    public function destroy(Kejadian_siswa $kejadian_siswa)
    {
        $kejadian_siswa->delete();
        $response = [
            'success' => 'success',
            'message' => 'Data kejadian siswa berhasil dihapus.'
        ];
        return response()->json($response, 200);
    }
    public function cari(Request $request)
    {
        if(Auth::user()->level == "guru")
        {
            $guruid = Auth::user()->id;
            $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                $s->whereHas('kelassw', function($k) use($guruid) {
                    $k->where('id_wali_kelas', $guruid);
                });
            });
        }
        elseif (Auth::user()->level == "orang_tua") {
            $ortuid = Auth::user()->id;
            $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                $s->where('id_ortu', $ortuid);
            });
        } 
        else 
        {
            $queryguruorortu = Kejadian_siswa::orderBy('id','desc');
        }

        $kata_kunci = $request->kata_kunci;
        $query = $queryguruorortu->whereHas('siswa', function($s) use($kata_kunci) {
            $s->where('nama_siswa', 'LIKE','%'.$kata_kunci.'%');
        });
        $kejadian_siswa_list = $query->with(['kejadian','siswa'])
        ->get();
        $jumlah_kejadian_siswa = $kejadian_siswa_list->count();
        $data = $kejadian_siswa_list->toArray();
        
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah_kejadian_siswa' => $jumlah_kejadian_siswa
        ];

        return response()->json($response, 200);
    }
    public function chatview(Kejadian_siswa $kejadian_siswa)
    {
        $forum_kejadian_list = Forum_kejadian::where('id_kejadian_siswa', $kejadian_siswa->id)->orderBy('created_at','desc')->with(['kejadian_siswa','kejadian_siswa.kejadian','kejadian_siswa.siswa','user'])->get();
        $data = $forum_kejadian_list->toArray();
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Forum kejadian retrieved successfully.',
        ];

        return response()->json($response, 200);
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
        $response = [
            'success' => 'success',
            'message' => 'Data chat berhasil ditambahkan.'
        ];
        return response()->json($response, 200);
    }
    public function chatdelete(Kejadian_siswa $kejadian_siswa, Forum_kejadian $forum_kejadian)
    {
        $delete = $forum_kejadian->delete();
        $notif_delete = Notif_bk::where('id_forum',$forum_kejadian->id);
        $notif_delete->delete();
        $response = [
            'success' => 'success',
            'message' => 'Data chat berhasil dihapus.'
        ];
        return response()->json($response, 200);
    }
}
