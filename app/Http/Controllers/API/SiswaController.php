<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Siswa;
use App\Kelassw;
use App\User;
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
            'jumlah_siswa' => $jumlah_siswa
        ];

        return response()->json($response, 200);
    }
}
