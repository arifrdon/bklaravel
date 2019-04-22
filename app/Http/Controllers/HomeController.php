<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian;
use App\Kejadian_siswa;
use App\Forum_kejadian;
use App\Siswa;
use App\Kelassw;
use App\User;
use Auth;
use Hash;
use DB;
use Session;
use App\Http\Requests\ChangePasswordRequest;

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
        if(Auth::user()->level == 'orang_tua'){
            // $abc = Siswa::with(['kejadian' => function($query) {
            //     $query->orderBy('id', 'desc');
            // }])->get()->toJson();
            // dd($abc);

            return view('dashboard.indexforwali');
        } else {
            $kejadian_count = Kejadian::count();
            $kejadian_siswa_count = Kejadian_siswa::count();
            $orang_tua_interaksi_count = Forum_kejadian::whereHas('user', function($u) {
                $u->where('level', 'orang_tua');
            })->count();
            $datahighchart = DB::select('select id, COUNT(1) AS entries, UNIX_TIMESTAMP(DATE_ADD(DATE(tanggaljam_kejadian), INTERVAL 7 HOUR)) as tanggal from kejadian_siswa group by tanggal');
            return view('dashboard.index',compact('kejadian_count','kejadian_siswa_count','orang_tua_interaksi_count','datahighchart'));
        }
        
        
    }
    public function editPassword()
    {
        return view('auth.passwords.changepassword');
    }
    public function updatePassword(ChangePasswordRequest $request)
    {
        $current_password = Auth::user()->password;
        if(Hash::check($request->cur_pass, $current_password))
        {
            $user_id = Auth::user()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->new_pass);
            $obj_user->save();
            Session::flash('flash_message', 'Data password berhasil diupdate.');
            return redirect('/');
        } 
        else 
        {
            Session::flash('flash_message_fail', 'Data password gagal diupdate. Password saat ini salah');
            return redirect('change_password');
        }
        
    }
}
