<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kejadian;

class KejadianController extends Controller
{
    public function index(){
        $kejadian_list = Kejadian::orderBy('nama_kejadian','asc')
        ->get();
        $jumlah_kejadian = Kejadian::count();

        $data = $kejadian_list->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Kejadian retrieved successfully.',
            'jumlah_kejadian' => $jumlah_kejadian
        ];

        return response()->json($response, 200);
    }
}
