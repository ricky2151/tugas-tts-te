<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function home(){
        $data = DB::table('anggota')->first();

        //return response()->json($data);

        return view('index');
    }
}
