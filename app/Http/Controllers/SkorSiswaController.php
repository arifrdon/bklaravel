<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian_siswa;
use App\Siswa;
use App\Kejadian;
use App\User;
use App\MyCustomClass\PDF_MC_Table;
use Session;
use Carbon\Carbon;
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
        
        $skor_list = Siswa::with('kejadian')->has('kejadian_siswa')->Paginate(5);
        $jumlah_skor = Siswa::with('kejadian')->has('kejadian_siswa')->count();
        return view('skor_siswa.index', compact('skor_list','jumlah_skor'));
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
        $mycount = Siswa::with('kejadian')->has('kejadian_siswa')->count();
        foreach($teacher1WithStudents as $tws)
        {
            echo $tws->kejadian->where('tipe_kejadian','pelanggaran');
            //echo $tws."<br> <br>";
        }

        echo "the count is:".$mycount;
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
        $skor_detail = Siswa::with('kejadian')->has('kejadian_siswa')->find($id);

        return view('skor_siswa.show', compact('skor_detail'));
    }
    public function pdf($id)
    {
        $sd = Siswa::with('kejadian')->has('kejadian_siswa')->find($id);
        $kepsek = User::where('level','kepala_sekolah')->first();

        $pdf = new PDF_MC_Table( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();

        //header awal

        $pdf->SetFont('Arial','B',15);
        // Move to the right
        //$this->Cell(100);
        // Title
        //nantiditambah
                //$pdf->Image('../../imagesupload/logoparlaungan.jpg',10,8,20,20);
                
                //$pdf->Image('../../imagesupload/logoparlaungan.jpg',180,8,20,20);
        
        $pdf->Cell(0,5,'Lembaga Pendidikan SMP ABC',0,1,'C');
        $pdf->Cell(0,5,'Sekolah Menengah Pertama ABC',0,1,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,5,'Jl ABC Sidoarjo',0,1,'C');
            $pdf->Cell(0,5,'Website www.abc.abc',0,1,'C');
            $pdf->Cell(0,5,'',0,1,'C');
        // Line break
        $pdf->SetFont('Arial','',11);
        $pdf->Line(5, 32, 210-5, 32);
        $pdf->Cell(0,5,'Lampiran    : 1(satu) lembar',0,1,'L');
        $pdf->Cell(0,5,'Hal              : Pemberitahuan Ke Orang Tua',0,1,'L');
        $pdf->Cell(0,5,'',0,1,'L');
        $pdf->Cell(0,5,'Kepada Yth.',0,1,'L');
        $pdf->Cell(0,5,'Bapak/Ibu '.$sd->user->name,0,1,'L');
        $pdf->Cell(0,5,'Di Tempat ',0,1,'L');
        $pdf->Ln(15);
            
        //header akhir

        $pdf->SetFont('Times','I',11);
        $pdf->Cell(0,5,'Bismillaahirrohmaanirrohiim',0,1,'C');
        $pdf->Cell(0,5,'',0,1,'C');
        $pdf->Cell(0,5,'Assalamu\'alaikum Wr.Wb',0,1,'L');
        $pdf->Cell(0,5,'',0,1,'C');
        $pdf->SetFont('Times','',11);
        $reportSubtitle = "            Alhamdulillah, segala puji hanya milik Allah S.W.T, sholawat serta salam semoga tetap tercurah kepada Rasulullah Muhammad SAW beserta keluarga, sahabat dan segenap pengikutnya sehingga kita tergolong pengikut beliau yang setia. Amin.";
        $reportSubtitle2 = "            Sehubungan dengan pelanggaran yang kerap dilakukan oleh siswa Bapak / Ibu atas nama : ";
        $namasiswa = "            ".$sd->nama_siswa."                       No Induk : ".$sd->nisn;
        $reportSubtitle3 = "Maka kami memberitahukan hal ini kepada Bapak/ Ibu agar dapat diberi perhatian khusus kepada putra / putrinya";
        $reportSubtitle4 = "            Demikian surat pemberitahuan ini. Semoga Allah SWT meridhoi segala upaya kita. Amin.";
        $reportSubtitle5 = "Wassalamu'alaikum Wr.Wb";
        $tandatgn1="Sidoarjo, ".$dt = Carbon::now()->format('d-F-Y');
        $tandatgn2="Kepala Sekolah";
        //$tandatgn3="SMP Islam Parlaungan";
        $tandatgn4="".$kepsek->name;
        $pdf->MultiCell( 0, 5, $reportSubtitle, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle2, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell( 0, 5, $namasiswa, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','',11);
        $pdf->MultiCell( 0, 5, $reportSubtitle3, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle4, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle5, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn1, 0);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn2, 0);
        $pdf->cell(129);
        //$pdf->MultiCell( 0, 5, $tandatgn3, 0);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','BU',11);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn4, 0);

        //footer awal

            $pdf->SetY(-38);

            $pdf->SetFont('Arial','',8);
        //	$pdf->Cell(0,5,'Islamic International School of Al Falah Darussalam',0,1,'C');
        //		$pdf->Cell(0,5,'Al Falah Darussalam Primary School',0,1,'C');
        //		$pdf->SetFont('Arial','I',8);
        //		$pdf->Cell(0,5,'Let\'s go to be Better for Excellent Future',0,1,'C');
        //		$pdf->SetFont('Arial','',8);

        //footer akhir
        $pdf->AddPage();
        $lamp1="LAMPIRAN";
        $lamp2="No Induk: ".$sd->nisn;
        $lamp3="NAMA: ".$sd->nama_siswa;
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->Cell( 18, 5, $lamp1,1,1);
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell( 0, 5, $lamp2, 0);
        $pdf->MultiCell( 0, 5, $lamp3, 0);
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->MultiCell( 0, 5, '', 0);
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->SetY(38);
        $pdf->SetX(10);
        $pdf->MultiCell(50,6,'Nama Kejadian',1);
        $pdf->SetY(38);
        $pdf->SetX(60);
        $pdf->MultiCell(80,6,'Tanggal Kejadian',1);
        $pdf->SetY(38);
        $pdf->SetX(140);
        $pdf->MultiCell(30,6,'Tipe Kejadian',1,'R');
        $pdf->SetY(38);
        $pdf->SetX(170);
        $pdf->MultiCell(30,6,'Poin ',1,'R');
        */

        $c_nama = "";
        $c_tanggal = "";
        $c_tipe = "";
        $c_poin = "";
        $awal = config('poin_awal');
        $total=0;

        $pdf->SetY(44);
        $pdf->SetX(10);
        $pdf->MultiCell(80,6,'Poin Awal : '.config('poin_awal'),0);
        $pdf->SetY(44);
        $pdf->SetX(90);
        $pdf->MultiCell(50,6,'',0);
        $pdf->SetY(44);
        $pdf->SetX(140);
        $pdf->MultiCell(30,6,'',0,'R');
        $pdf->SetY(44);
        $pdf->SetX(170);
        $pdf->MultiCell(30,6,'',0,'R');
        $pdf->MultiCell( 0, 5, '', 0,1);

        $pdf->SetFont('times','B',10);
        $pdf->SetWidths(array(80, 50, 30, 30));
        //$pdf->SetHeight(0.1);
        $pdf->Row(array("Nama kejadian", "Tanggal", "Tipe", "Poin"));
    
        //For each row, add the field to the corresponding column
        foreach($sd->kejadian as $r2){
            $poin2 = $r2->poin_kejadian;
            $newDate = $r2->pivot->tanggaljam_kejadian->format('d-m-Y H:i');

            if ($r2->tipe_kejadian=='reward'){
                if(config('fitur_reward') == 1){
                    $pdf->SetFont('times','',10);
                    if(config('operator_bk') == "kurang"){
                        $pdf->Row(array($r2->nama_kejadian, $newDate, $r2->tipe_kejadian, '+'.$poin2));
                        $total = $total+($r2->poin_kejadian);
                    }
                    if(config('operator_bk') == "tambah"){
                        $pdf->Row(array($r2->nama_kejadian, $newDate, $r2->tipe_kejadian, '-'.$poin2));
                        $total = $total-($r2->poin_kejadian);
                    }
                }
            } 
                else 
            {
                if(config('operator_bk') == "kurang"){
                    $pdf->SetFont('times','',10);
                    $pdf->Row(array($r2->nama_kejadian, $newDate, $r2->tipe_kejadian, '-'.$poin2));
                    $total = $total-($r2->poin_kejadian);
                }
                if(config('operator_bk') == "tambah"){
                    $pdf->SetFont('times','',10);
                    $pdf->Row(array($r2->nama_kejadian, $newDate, $r2->tipe_kejadian, '+'.$poin2));
                    $total = $total+($r2->poin_kejadian);
                }
            }

        }
        $hasilakhir = $awal+$total;
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell(0, 5, '', 0,1);
        $pdf->MultiCell(30,6,'TOTAL : '.$hasilakhir,0,'L');

        $pdf->Output();
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
