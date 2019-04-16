<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian_siswa;
use App\Siswa;
use App\Kejadian;

use Session;

class SkorSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadian_siswa_list = Kejadian_siswa::orderBy('id','desc')
        ->Paginate(5);
        $jumlah_kejadian_siswa = Kejadian_siswa::count();

        $myexp = Kejadian_siswa::all();
        $mysis = Siswa::has('kejadian_siswa')->get();
        //print_r($myexp);
        // foreach($mysis as $myx)
        // {
        //     echo $myx->nama_siswa." ";
        // }

        // foreach( $mysis->kejadian_siswa as $abc)
        // {
        //     echo $abc->tanggaljam_kejadian." <br>";
        // } ;

        //echo $mysis->kejadian_siswa->sum('id_kejadian');
        
        foreach($mysis as $mys)
        {
            echo "noindukyaa".$mys->nisn." ";
            echo "poin awal".config('poin_awal')." ";
            $pp = 0;
            $pr = 0;
            // echo $mys->kejadian_siswa->sum(($kejadian->poin_kejadian));
            //$bc = $mys->kejadian_siswa;
            //echo $abc =  $bc->kejadian->where('tipe_kejadian','pelanggaran')->get()->sum('poin_kejadian');
            
            foreach($mys->kejadian_siswa as $bc )
            {
                if($bc->kejadian->tipe_kejadian == "pelanggaran")
                {
                    $pp = $pp+$bc->kejadian->poin_kejadian;
                } elseif($bc->kejadian->tipe_kejadian == "reward")
                {
                    $pr = $pr+$bc->kejadian->poin_kejadian;
                }
            }
            echo "poin pelanggaran". $pp;
            echo "poin reward". $pr;
            //echo $abc;
            //print_r($qs);
            $pa = $pp-$pr;
            echo "poin_akhir: ". $pa;
            echo "<br>";
            echo "<br>";
        }
        return view('skor_siswa.index', compact('kejadian_siswa_list','jumlah_kejadian_siswa'));
    }
    public function bismillahtest()
    {
        // $a = Siswa::find(1)->kejadian[3]->nama_kejadian;
        // // foreach($a as $b)
        // // {
        //     echo $a."<br> <br>";
        // // }

        // $siswa = Siswa::with('kejadian')->get();

        // foreach ($siswa as $sw) {
        //     foreach ($sw as $st)
        //     {
        //         echo $st->nama_kejadian." <br> <br>";
        //     }
           
        // }
     //echo   json_encode($siswa, JSON_PRETTY_PRINT);
    //echo $siswa;

    // $siswa = Siswa::find(1);
    // $kejadian = new \App\Kejadian;
    // $kejadian->id_kejadian = 1;
    // $kejadian->tanggaljam_kejadian = '2018-01-23 11:53:20';
    // $kejadian->status_terkirim = 0;
    // $kejadian->created_at = '2018-01-23 11:53:20';
    // $kejadian->updated_at = '2018-01-23 11:53:20';
    // // $siswa->kejadian->save($kejadian);
    // \App\Siswa::find(1)->kejadian()->save($kejadian, ['tanggaljam_kejadian' => "2018-01-23 11:53:20"]);

    // $teacher1WithStudents = \App\Siswa::with('kejadian')->find(1);
    //     echo $teacher1WithStudents->kejadian->where('tipe_kejadian','pelanggaran')->sum('poin_kejadian');
        
        //echo $teacher1WithStudents->kejadian->nama_kejadian;
        // foreach($teacher1WithStudents->kejadian as $tk)
        // {
        //     echo $tk->pivot->deleted_at." <br><br>";
        // }
        $teacher1WithStudents = Siswa::with('kejadian')->has('kejadian_siswa')->get();
        
        foreach($teacher1WithStudents as $tws)
        {
            echo $tws->kejadian->where('tipe_kejadian','pelanggaran')->sum('poin_kejadian');
            //echo $tws."<br> <br>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
