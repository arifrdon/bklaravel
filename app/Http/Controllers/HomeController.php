<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kejadian;
use App\Kejadian_siswa;
use App\Forum_kejadian;
use App\Notif_bk;
use App\Siswa;
use App\Kelassw;
use App\User;
use App\Image;
use Auth;
use Hash;
use DB;
use Session;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ImageRequest;

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
            $ortuid = Auth::user()->id;
            $resume_siswa_list = Siswa::where('id_ortu',$ortuid)->with(['kejadian' => function($query) {
                $query->orderBy('id', 'desc')->take(3);
            }])->get();

            return view('dashboard.indexforwali', compact('resume_siswa_list'));
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
    public function fetchnotif(Request $request)
    {
        $output = '';
        $jmllistnotif = 0;
        $qnotif = [];
        $notif_list = [];
        $qcountnotif = 0;
        if(Auth::user()->level == 'orang_tua')
        {
            $ortuid = Auth::user()->id;
            $qnotif = Notif_bk::whereHas('forum_kejadian', function($f) use($ortuid){
                $f->whereHas('kejadian_siswa', function($k) use($ortuid){
                    $k->whereHas('siswa', function($s) use($ortuid){
                        $s->where('id_ortu', $ortuid);
                    });
                });
            })
            ->whereHas('forum_kejadian', function($f) {
                $f->whereHas('user', function($u){
                    $u->where('level','!=','orang_tua');
                });
            });

            $notif_list = $qnotif->orderBy('id','desc')->get();
            $qcountnotif = $qnotif->where('sudah_baca', '0')->count();
            if($request->view != ""){
                $updatequery = $qnotif->update(['sudah_baca' => "1"]);
            }
        }
        elseif (Auth::user()->level == 'guru') 
        {
            $guruid = Auth::user()->id;
            $qnotif = Notif_bk::whereHas('forum_kejadian', function($f) use($guruid){
                $f->whereHas('kejadian_siswa', function($k) use($guruid){
                    $k->whereHas('siswa', function($s) use($guruid){
                        $s->whereHas('kelassw', function($ks) use($guruid) {
                            $ks->where('id_wali_kelas',$guruid);
                        });
                    });
                });
            })
            ->whereHas('forum_kejadian', function($f) {
                $f->whereHas('user', function($u){
                    $u->where('level','orang_tua');
                });
            });
            $notif_list = $qnotif->orderBy('id','desc')->get();
            $qcountnotif = $qnotif->where('sudah_baca', '0')->count();
            if($request->view != ""){
                $updatequery = $qnotif->update(['sudah_baca' => "1"]);
            }
        }
        elseif (Auth::user()->level == 'guru_bk' || Auth::user()->level == 'admin' || Auth::user()->level == 'kepala_sekolah') 
        {
            $qnotif = Notif_bk::whereHas('forum_kejadian', function($f) {
                $f->whereHas('user', function($u){
                    $u->where('level','orang_tua');
                });
            });
            $notif_list = $qnotif->orderBy('id','desc')->get();
            $qcountnotif = $qnotif->where('sudah_baca', '0')->count();
            if($request->view != ""){
                $updatequery = $qnotif->update(['sudah_baca' => "1"]);
            }
        }
        if(count($notif_list)>0){
            foreach ($notif_list as $ln){
                $output .="<div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='".url('kejadian_siswa/'.$ln->forum_kejadian->id_kejadian_siswa.'/chatview')."'><strong>".ucwords(str_replace('_', ' ', $ln->forum_kejadian->user->level)).": ".ucwords($ln->forum_kejadian->user->name)."</strong><br><small><strong>Mengomentari kejadian ".ucwords($ln->forum_kejadian->kejadian_siswa->siswa->nama_siswa)."</strong></small><br><small><strong><u>".$ln->forum_kejadian->kejadian_siswa->kejadian->nama_kejadian."</u></strong></small><br><small>".$ln->forum_kejadian->kejadian_siswa->tanggaljam_kejadian->format('d-m-Y H:i')."</small></a><div class='dropdown-divider'></div>";   
            }
        } 
        else 
        {
            $output .= "<a class='dropdown-item' href='#'>No Notification</a>";
        }
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $qcountnotif
        );
        echo json_encode($data);
    }
    public function exp(){
        $ortuid = Auth::user()->id;
            $qnotif = Notif_bk::whereHas('forum_kejadian', function($f) use($ortuid){
                $f->whereHas('kejadian_siswa', function($k) use($ortuid){
                    $k->whereHas('siswa', function($s) use($ortuid){
                        $s->where('id_ortu', $ortuid);
                    });
                });
            })
            ->whereHas('forum_kejadian', function($f) {
                $f->whereHas('user', function($u){
                    $u->where('level','!=','orang_tua');
                });
            })->orderBy('id','desc')->get();

            foreach ($qnotif as $q){
                echo $q->id;
            }

            
            print_r($qnotif);

            if(!empty($qnotif)){
                $a = "";
                echo "tidak empty";
                echo count($qnotif);
            } else {
                echo "empty";
            }
    }
    public function imageshow()
    {
        $image_list = Image::all();
        return view('image.show', compact('image_list'));
    }
    public function imagecreate()
    {
        return view('image.create');
    }
    public function imagestore(ImageRequest $request)
    {
        if($request->hasfile('imagepath'))
        {
            echo "1";
            $foto = $request->file('imagepath');
            $ext = $foto->getClientOriginalExtension();
            if($foto->isValid())
            {
                echo "2";
                $newname = date('YmdHis').".$ext";
                $foto->move(public_path().'/fotopribadi/', $newname);
                $var_save = new Image;
                $var_save->imagepath = $newname;
                $var_save->save();
            }
        } else {
            echo "3";
        }
        Session::flash('flash_message', 'Data foto berhasil disimpan.');
        return redirect('imageshow');
    }
    public function imagedelete(Image $image)
    {
        if(\File::exists(public_path('fotopribadi/'.$image->imagepath))){
            \File::delete(public_path('fotopribadi/'.$image->imagepath));
        }else{
            dd(public_path('fotopribadi/'.$image->imagepath));
        }
        $image->delete();
        Session::flash('flash_message', 'Data foto berhasil dihapus.');
        return redirect('imageshow');
    }
}
