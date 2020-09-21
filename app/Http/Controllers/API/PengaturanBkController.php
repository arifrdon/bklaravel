<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengaturan_bk;
use App\Http\Requests\PengaturanBkRequest;

class PengaturanBkController extends Controller
{
    public function show_pengaturan()
    {
        $qpengaturan = Pengaturan_bk::orderBy('id')->get();
        $data = $qpengaturan->toArray();
        $jumlah_pengaturan = $qpengaturan->count();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Pengaturan retrieved successfully.',
            'jumlah' => $jumlah_pengaturan
        ];

        return response()->json($response, 200);
    }
    public function update_pengaturan(PengaturanBkRequest $request)
    {
        Pengaturan_bk::where('id',1)->update(['nilai_pengaturan'=> $request->poin_awal]);
        Pengaturan_bk::where('id',2)->update(['nilai_pengaturan'=> $request->fitur_reward]);
        Pengaturan_bk::where('id',3)->update(['nilai_pengaturan'=> $request->operator_bk]);
        $response = [
            'success' => 'success',
            'message' => 'Data pengaturan berhasil diupdate.'
        ];
        return response()->json($response, 200);
    }
}
