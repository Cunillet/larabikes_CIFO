<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function deletedBikes(Request $request) {
        $bikes = Bike::onlyTrashed()->get();
        return view('admin.deletedbikes', ['bikes' => $bikes]);
    }

    public function usersList(Request $request) {
        $users = User::all();
        return view('admin.userslist', ['users' => $users]);
    }
}
