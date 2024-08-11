<?php

namespace App\Http\Controllers\API;

use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $req){
        $cradential = [
            'email'    => $req->email,
            'password' => $req->password
        ];

        if(Auth::attempt($cradential)){
            $success = true;
            $message = 'Login Success';
        }else{
            $success = false;
            $message = 'Login fail';
        }

        $response = ['success'=>$success,'message'=>$message];
        return response()->json($response);
    }

    public function register(Request $req){
        
        $userCheck = User::where('email',$req->email);
        if($userCheck->count()){
            $success = false;
            $message = 'This email have used';
        }else{
            try {
                $tbl             = new User();
                $tbl->name       = $req->name;
                $tbl->email      = $req->email;
                $tbl->password   = Hash::make($req->password);
                $tbl->save();
                
                $success = true;
                $message = 'Register success';
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message  = $ex->getMessage();
            }
        }       

        $response = ['success'=>$success,'message'=>$message];
        return response()->json($response);
    }

    public function logout(){
        try {
            Session::flush();
            $success = true;
            $message = 'Logout success';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message  = $ex->getMessage();
        }
        $response = ['success'=>$success,'message'=>$message];
        return response()->json($response);
    }
}
