<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ModelSiswa;

class AutocompleteController extends Controller
{
    //
    public function index(){
    	return view('autocomplete.autocomplete');
    }

    public function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('tb_siswa')
        ->where('nama_siswa', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="/home">'.$row->nama_siswa.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
