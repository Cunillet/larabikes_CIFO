<?php

namespace App\Http\Controllers;

use App\Models\Bike;

class HomeController extends Controller
{
    public function index()
    {
        // direct call to static method
        // $bikes = Moto::getLatestWithImage(4);

        $bikes = Bike::withImage()
                          ->latest()
                          ->limit(4)
                          ->get();

        return view('welcome', compact('bikes'));
    }
}
