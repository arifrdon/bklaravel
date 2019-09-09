<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    public function login()
    {
        $column_decider = filter_var(request('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$column_decider => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['halo'] = Auth::user()->level;

            return response()->json(['success' => $success, 'suksesku' => 'adalah takdirku'], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['logout' => 'logged out'], 401);
    }
}
