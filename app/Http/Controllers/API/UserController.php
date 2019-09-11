<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\HasApiTokens;
use App\Http\Requests\ChangePasswordRequest;
use Hash;

class UserController extends Controller
{
    use HasApiTokens;

    public function login(Request $request)
    {
        $column_decider = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$column_decider => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['id'] = Auth::user()->id;
            $success['username'] = Auth::user()->username;
            $success['name'] = Auth::user()->name;
            $success['email'] = Auth::user()->email;
            $success['level'] = Auth::user()->level;
            $success['nomor_telepon'] = Auth::user()->nomor_telepon;
            $success['alamat'] = Auth::user()->alamat;

            return response()->json(['success' => $success, 'message' => 'adalah takdirku'], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user()->token();
        if($user->revoke()){
            return response()->json(['success' => 'success', 'message' => 'logged out'], 200);
        } else {
            return response()->json(['error' => 'Unknown Error'], 401);
        }
        
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
            return response()->json(['success' => 'success', 'message' => 'Data password berhasil diupdate.'], 200);
        } 
        else 
        {
            return response()->json(['error' => 'Data password gagal diupdate. Password saat ini salah'], 401);
        }
        
    }
}
