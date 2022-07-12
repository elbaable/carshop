<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $cars = Car::orderBy('make', 'desc')->get();
        $types = Car::select('model')->groupBy('model')->get();
        return view('welcome')->with(compact('cars', 'types'));
    }

    public function get_option(Request $request){
        $type = $request->input('type');
        $order = $request->input('order');
        if($type == 'all'){
            $cars = Car::orderBy($order, 'desc')->get();
        }else{
            $cars = Car::where('model', 'like', '%' . $type . '%')->orderBy($order, 'desc')->get();
        }
        return $cars;
    }
}