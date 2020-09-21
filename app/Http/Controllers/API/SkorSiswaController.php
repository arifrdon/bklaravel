<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Kejadian_siswa;
use App\Siswa;
use App\Kelassw;
use App\Kejadian;
use App\User;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class SkorSiswaController extends Controller
{
    public function index()
    {   
        $response = $this->queryskor(0,"");
        return response()->json($response, 200);
    }
    public function search_siswa($id_siswa = 0)
    {
        $response = $this->queryskor($id_siswa,"");
        return response()->json($response, 200);
    }
    public function show($id){
        if(config('fitur_reward') == 0){
            $katapelanggaran = "pelanggaran";
            $skor_detail = Siswa::with(['user','kelassw.user','kejadian' => function($q) use($katapelanggaran) {
                // Query the name field in status table
                $q->where('tipe_kejadian', $katapelanggaran); // '=' is optional
            }])->has('kejadian_siswa')
            ->find($id);
        } else {
            $skor_detail = Siswa::with('kejadian','user','kelassw.user')->has('kejadian_siswa')->find($id);
        }
        
        $data = $skor_detail->toArray();
        $jumlah_skor = $skor_detail->count();
        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Skor siswa retrieved successfully.',
            'jumlah' => $jumlah_skor,
        ];
        return response()->json($response, 200);
    }
    public function cari(Request $request)
    {
        
        $kata_kunci = $request->kata_kunci;
        $response = $this->queryskor(0,$kata_kunci);
        return response()->json($response, 200);
    }
    private function queryskor($id_siswa = 0, $kata_kunci = "")
    {
        $qwherewali = "";
        $qwhereortu = "";
        $qwheresiswa = "";
        $qidsiswa = "%%";
        $qwherekatakunci = "";
        $qkatakunci = "%%";
        $arrq = [];

        if(config('fitur_reward') == 1){
            $subpoinreward = "SELECT CAST( COALESCE(sum( a.poin_kejadian ), 0) as SIGNED) 
            FROM kejadian as a 
            INNER JOIN kejadian_siswa as b ON a.id = b.id_kejadian 
            WHERE b.id_siswa = noindukdistinct 
            AND a.tipe_kejadian = 'reward'  AND b.deleted_at IS NULL";
        }

        $subpoinpelanggaran = "SELECT CAST( COALESCE(sum( a.poin_kejadian ), 0) as SIGNED) 
        FROM kejadian as a 
        INNER JOIN kejadian_siswa as b ON a.id = b.id_kejadian 
        WHERE b.id_siswa = noindukdistinct
        AND a.tipe_kejadian = 'pelanggaran' 
        AND b.deleted_at IS NULL";

        if(Auth::user()->level == "guru"){
            $qwherewali = " and d.id = ".Auth::user()->id;
        }
        if(Auth::user()->level == "orang_tua"){
            $qwhereortu = " and ortue.id = ".Auth::user()->id;
        }
        if($id_siswa != 0){
            $qwheresiswa = " and b.id = :id_siswa";
            $qidsiswa = $id_siswa;
            $arrq = array(
                'id_siswa' => $qidsiswa,
            );
        }
        if($kata_kunci != ""){
            $qwherekatakunci = " and b.nama_siswa LIKE :kata_kunci";
            $qkatakunci = "%".$kata_kunci."%";
            $arrq = array(
                'kata_kunci' => $qkatakunci,
            );
        }
        
        
        $query_submaster_clause_where = " WHERE a.deleted_at IS NULL ";

        $query_submaster_clause = " FROM kejadian_siswa as a
        INNER JOIN siswa as b ON a.id_siswa = b.id 
        INNER JOIN kelassw as c ON b.id_kelas = c.id
        INNER JOIN users as d ON c.id_wali_kelas = d.id 
        INNER JOIN users as ortue ON b.id_ortu = ortue.id ".$query_submaster_clause_where.$qwherewali.$qwhereortu.$qwheresiswa.$qwherekatakunci;

        if(config('fitur_reward') == 1){
            $query_submaster_select = "SELECT distinct(a.id_siswa) as noindukdistinct, b.nama_siswa as namasiswa, 
            (SELECT CAST(nilai_pengaturan as SIGNED) 
            FROM pengaturan_bk 
            WHERE id=1) as poin_awal,
                (".$subpoinreward.") as poin_reward,
                (".$subpoinpelanggaran.") as poin_pelanggaran ";
        }
        if(config('fitur_reward') == 0){
            $query_submaster_select = "SELECT distinct(a.id_siswa) as noindukdistinct, b.nama_siswa as namasiswa, 
            (SELECT nilai_pengaturan 
            FROM pengaturan_bk 
            WHERE id=1) as poin_awal,
                (".$subpoinpelanggaran.") as poin_pelanggaran ";
        }
        $query_submaster_select = $query_submaster_select.$query_submaster_clause;

        if(config('fitur_reward') == 1 && config('operator_bk') == "tambah"){
            $query_master_select = "SELECT noindukdistinct as id_siswa, namasiswa as nama_siswa, poin_awal, poin_reward, poin_pelanggaran, (poin_awal-poin_reward+poin_pelanggaran) as poin_akhir ";
        }
        if(config('fitur_reward') == 1 && config('operator_bk') == "kurang"){
            $query_master_select = "SELECT noindukdistinct as id_siswa, namasiswa as nama_siswa, poin_awal, poin_reward, poin_pelanggaran, (poin_awal+poin_reward-poin_pelanggaran) as poin_akhir ";
        }
        if(config('fitur_reward') == 0 && config('operator_bk') == "tambah"){
            $query_master_select = "SELECT noindukdistinct as id_siswa, namasiswa as nama_siswa, poin_awal, poin_pelanggaran, (poin_awal+poin_pelanggaran) as poin_akhir ";
        }
        if(config('fitur_reward') == 0 && config('operator_bk') == "kurang"){
            $query_master_select = "SELECT noindukdistinct as id_siswa, namasiswa as nama_siswa, poin_awal, poin_pelanggaran, (poin_awal-poin_pelanggaran) as poin_akhir ";
        }

        $query_master_select = $query_master_select."FROM (".$query_submaster_select.") abcd";

        $allquery = DB::select(DB::raw($query_master_select), $arrq);
        $data = collect($allquery);
        $jumlah_skor = $data->count();

        $response = [
            'success' => 'success',
            'data' => $data,
            'message' => 'Skor siswa retrieved successfully.',
            'jumlah' => $jumlah_skor,
            'fitur_reward' => config('fitur_reward')
        ];

        return $response;
    }
    private function myfunc(){
        echo "heyheyheyo";
    }
}
