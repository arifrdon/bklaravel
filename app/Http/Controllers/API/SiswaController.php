<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Siswa;
use App\Kelassw;
use App\User;
use App\Kejadian;
use Auth;

class SiswaController extends Controller
{
    public function index(){
        if(Auth::user()->level == "guru"){
            $guruid = Auth::user()->id;
            $qsiswa = Siswa::orderBy('nama_siswa')->whereHas('kelassw', function($s) use($guruid) {
                $s->where('id_wali_kelas', $guruid);
            });
        } else {
            $qsiswa = Siswa::orderBy('nama_siswa');
        }
        $siswa_list = $qsiswa->get();
        $jumlah_siswa = $siswa_list->count();

        $data = $siswa_list->toArray();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Siswa retrieved successfully.',
            'jumlah' => $jumlah_siswa
        ];

        return response()->json($response, 200);
    }

    public function siswakejadian_dropdown(){
        if(Auth::user()->level == "guru"){
            $guruid = Auth::user()->id;
            $qsiswa = Siswa::orderBy('nama_siswa')->whereHas('kelassw', function($s) use($guruid) {
                $s->where('id_wali_kelas', $guruid);
            });
        } else {
            $qsiswa = Siswa::orderBy('nama_siswa');
        }
        $siswa_list = $qsiswa->get();
        $jumlah_siswa = $siswa_list->count();

        $data_siswa = $siswa_list->toArray();

        //-------------------------------
        if(config('fitur_reward') == 0){
            $kejadian_list = Kejadian::where('tipe_kejadian','pelanggaran')->orderBy('nama_kejadian','asc')
            ->get();
        } else {
            $kejadian_list = Kejadian::orderBy('nama_kejadian','asc')
        ->get();
        }
        
        $jumlah_kejadian = $kejadian_list->count();

        $data_kejadian = $kejadian_list->toArray();

        $response = [
            'success' => 'success',
            'data_siswa' => $data_siswa,
            'data_kejadian' => $data_kejadian,
            'message' => 'Siswa dan Kejadian retrieved successfully.',
            'jumlah_siswa' => $jumlah_siswa,
            'jumlah_kejadian' => $jumlah_kejadian
        ];

        return response()->json($response, 200);
    }
}
