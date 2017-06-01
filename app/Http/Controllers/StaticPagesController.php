<?php

namespace App\Http\Controllers;

use App\Molde\Plan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home()
    {
        return view('static_pages/home');
    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }






    public function index(){
        return view('demo.index');
    }

    public function plan(){

        $plan = Plan::all();
        var_dump($plan);

        return view('demo.index');
    }

    public function demoPost($o,$c){

        dd($c);
    }
}
