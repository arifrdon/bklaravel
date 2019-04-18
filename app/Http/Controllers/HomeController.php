<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian;
use App\Kejadian_siswa;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kejadian_count = Kejadian::count();
        $kejadian_siswa_count = Kejadian_siswa::count();
        $datahighchart = DB::select('select id, COUNT(1) AS entries, UNIX_TIMESTAMP(DATE_ADD(DATE(tanggaljam_kejadian), INTERVAL 7 HOUR)) as tanggal from kejadian_siswa group by tanggal');
        return view('dashboard.index',compact('kejadian_count','kejadian_siswa_count','datahighchart'));
    }
}
