<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KejadianRequest;
use App\Kejadian;

class KejadianController extends Controller
{
    public function index(){
        $kejadian_list = Kejadian::orderBy('nama_kejadian','asc')
        ->get();
        $jumlah_kejadian = Kejadian::count();

        $data = $kejadian_list->toArray();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah_kejadian' => $jumlah_kejadian
        ];

        return response()->json($response, 200);
    }
    public function show(Kejadian $kejadian)
    {
        $data = $kejadian->toArray();
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.'
        ];
        return response()->json($response, 200);
    }
    public function store(KejadianRequest $request)
    {
        //
        $input = $request->all();
        $kejadian = Kejadian::create($input);
        $response = [
            'success' => 'success',
            'message' => 'Data kejadian berhasil disimpan.'
        ];
        return response()->json($response, 200);
    }
    public function update(KejadianRequest $request, Kejadian $kejadian)
    {
        $input=$request->all();
        $kejadian->update($input);
        $response = [
            'success' => 'success',
            'message' => 'Data kejadian berhasil diupdate.'
        ];
        return response()->json($response, 200);
    }
    public function destroy(Kejadian $kejadian)
    {
        $kejadian->delete();
        $response = [
            'success' => 'success',
            'message' => 'Data kejadian berhasil dihapus.'
        ];
        return response()->json($response, 200);
    }

    public function cari(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $query = Kejadian::where('nama_kejadian', 'LIKE','%'.$kata_kunci.'%')->orderBy('nama_kejadian','asc');
        $kejadian_list = $query->get();
        $jumlah_kejadian = $kejadian_list->count();
        $data = $kejadian_list->toArray();
        
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah_kejadian' => $jumlah_kejadian
        ];

        return response()->json($response, 200);
    }
}
