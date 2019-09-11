<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KejadianSiswaRequest;
use Auth;
use App\Kejadian_siswa;

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
}
