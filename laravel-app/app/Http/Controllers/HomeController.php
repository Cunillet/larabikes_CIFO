<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userBikes = false;
        $user = $request->user();
        if (!empty($user) && $user->bikes->count() > 0) {
            $bikes = $user->bikes;
            $userBikes = true;
        } else {
            $bikes = Bike::withImage()
                ->latest()
                ->limit(4)
                ->get();
        }
        if ($user) {
            if ($user->hasRole(['admin'])) {
            $deletedBikes = Bike::onlyTrashed()->get();
            } else {
                $deletedBikes = Bike::onlyTrashed()
                    ->where('user_id', $user->id)
                    ->get();
            }
        } else {
            $deletedBikes = collect([]);
        }

        return view('welcome', [
            'bikes' => $bikes,
            'userBikes' => $userBikes,
            'deletedBikes' => $deletedBikes,
        ]);
    }
}
