<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\View\View;

class DevController extends Controller
{ 
    // function getMethod(){
    //     return 'hi!';
    // }
    public function getMethod(){
        // return view("welcome");
        return response()->json([
            'msg' => "json only"
        ]);
    }
}
