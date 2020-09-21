<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KejadianSiswaRequest;
use App\Http\Requests\ChatRequest;
use Auth;
use App\Kejadian_siswa;
use App\Siswa;
use App\Forum_kejadian;
use App\Notif_bk;
use App\Kelassw;

class KejadianSiswaController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == "guru")
        {
            $guruid = Auth::user()->id;
            if(config('fitur_reward') == 1){
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                    $s->whereHas('kelassw', function($k) use($guruid) {
                        $k->where('id_wali_kelas', $guruid);
                    });
                });
            } else {
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                    $s->whereHas('kelassw', function($k) use($guruid) {
                        $k->where('id_wali_kelas', $guruid);
                    });
                })->whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                });
            }
        } 
        elseif (Auth::user()->level == "orang_tua") {
            $ortuid = Auth::user()->id;
            if(config('fitur_reward') == 1){
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                    $s->where('id_ortu', $ortuid);
                });
            } else{
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                    $s->where('id_ortu', $ortuid);
                })->whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                });
            }
        }
        else 
        {
            if(config('fitur_reward') == 0){
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                })->orderBy('id','desc');
            } else {
                $queryguruorortu = Kejadian_siswa::orderBy('id','desc');
            }
        }

        $kejadian_siswa_list = $queryguruorortu->with(['kejadian','siswa'])
        ->get();
        $jumlah_kejadian_siswa = $queryguruorortu->count();
        $data = $kejadian_siswa_list->toArray();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah' => $jumlah_kejadian_siswa
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
            'message' => 'Kejadian siswa retrieved successfully.',
            'jumlah' => 1
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
            if(config('fitur_reward') == 1){
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                    $s->whereHas('kelassw', function($k) use($guruid) {
                        $k->where('id_wali_kelas', $guruid);
                    });
                });
            } else {
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($guruid) {
                    $s->whereHas('kelassw', function($k) use($guruid) {
                        $k->where('id_wali_kelas', $guruid);
                    });
                })->whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                });
            }
        }
        elseif (Auth::user()->level == "orang_tua") {
            $ortuid = Auth::user()->id;
            if(config('fitur_reward') == 1){
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                    $s->where('id_ortu', $ortuid);
                });
            } else{
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('siswa', function($s) use($ortuid) {
                    $s->where('id_ortu', $ortuid);
                })->whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                });
            }
        } 
        else 
        {
            if(config('fitur_reward') == 0){
                $katapelanggaran = "pelanggaran";
                $queryguruorortu = Kejadian_siswa::whereHas('kejadian', function($s) use($katapelanggaran){
                    $s->where('tipe_kejadian', $katapelanggaran);
                })->orderBy('id','desc');
            } else {
                $queryguruorortu = Kejadian_siswa::orderBy('id','desc');
            }
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
            'jumlah' => $jumlah_kejadian_siswa
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
    public function getreceiverid(Request $request){
        if(Auth::user()->level == "guru")
        {
            $idreceive = Siswa::select('id_ortu AS idreceiver')->where('id',$request->idsiswa)->first();
            //$data = $idreceive->toArray();
            $response = [
                'success' => 'kamu guru bk',
                'idreceiver' => $idreceive->idreceiver,
                'message' => 'Data id berhasil diexplore.'
            ];
        }elseif (Auth::user()->level == "orang_tua") {
            $idsiswa = $request->idsiswa;
            $idreceive = Kelassw::select('id_wali_kelas AS idreceiver')->whereHas('siswa', function($s) use($idsiswa) {
                $s->where('id',$idsiswa);
            });
            $pl = $idreceive->first();
            //$data = $idreceive->get()->toArray();
            $response = [
                'success' => 'kamu ortu',
                'idreceiver' => $pl->idreceiver,
                'message' => 'Data id berhasil diexplore.'
            ];
        }elseif (Auth::user()->level == "guru_bk") {
            $idreceive = Siswa::select('id_ortu AS idreceiver')->where('id',$request->idsiswa)->first();
            //$data = $idreceive->toArray();
            $response = [
                'success' => 'kamu guru bk',
                'idreceiver' => $idreceive->idreceiver,
                'message' => 'Data id berhasil diexplore.'
            ];
        }else {
            $response = [
                'success' => 'kamu gk tau',
                'idreceiver' => 0,
                'message' => 'Data id berhasil diexplore.'
            ];
        }
        
        return response()->json($response, 200);
    }
}
