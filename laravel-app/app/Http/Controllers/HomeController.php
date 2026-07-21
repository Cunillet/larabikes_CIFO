<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // direct call to static method
        // $bikes = Moto::getLatestWithImage(4);

        $userBikes = false;
        if (!empty($request->user()) && $request->user()->bikes->count() > 0) {
            $bikes = $request->user()->bikes;
            $userBikes = true;
        } else {
            $bikes = Bike::withImage()
                ->latest()
                ->limit(4)
                ->get();
        }

        return view('welcome', ['bikes' => $bikes, 'userBikes' => $userBikes]);
    }
}
