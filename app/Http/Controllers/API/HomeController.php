<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Kejadian;
use App\Kejadian_siswa;
use App\Forum_kejadian;
use App\Siswa;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index(){

        if(Auth::user()->level == 'orang_tua'){
            $ortuid = Auth::user()->id;
            if(config('fitur_reward') == 0){
                $resume_siswa_list = Siswa::where('id_ortu',$ortuid)->with(['kejadian' => function($query) {
                    $query->where('tipe_kejadian','pelanggaran')->orderBy('id', 'desc')->take(3);
                }])->get();
            } else {
                $resume_siswa_list = Siswa::where('id_ortu',$ortuid)->with(['kejadian' => function($query) {
                    $query->orderBy('id', 'desc')->take(3);
                }])->get();
            }
            
            $jumlah = $resume_siswa_list->count();
            $response = [
                'success' => 'success',
                'data' => $resume_siswa_list,
                'message' => 'Summary retrieved successfully.',
                'jumlah' => $jumlah,
            ];
        } else {
            $kejadian_count = Kejadian::count();
            $kejadian_siswa_count = Kejadian_siswa::count();
            $orang_tua_interaksi_count = Forum_kejadian::whereHas('user', function($u) {
                $u->where('level', 'orang_tua');
            })->count();
            $response = [
                'success' => 'success',
                'kejadian_count' => $kejadian_count,
                'kejadian_siswa_count' => $kejadian_siswa_count,
                'orang_tua_interaksi_count' => $orang_tua_interaksi_count,
                'message' => 'Summary retrieved successfully.',
            ];
        }

        return response()->json($response, 200);

    }
}
