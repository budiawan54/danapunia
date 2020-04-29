<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
class ControllerSiswa extends Controller
{
    //
    function dashboard(){
    	if(!Session::get('loginsiswa')){
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    		$user = DB::table('tb_user')->where('username',Session::get('user'))->get();
    		return view('siswa.dashboard',compact('user'));
    	}
    }
}
