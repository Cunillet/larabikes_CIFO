<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private int $pagination;

    public function __construct() {
        $this->pagination = config('pagination.bikes', 15);
    }

    public function deletedBikes(Request $request) {
        $bikes = Bike::onlyTrashed()->get();
        return view('admin.deletedbikes', ['bikes' => $bikes]);
    }

    public function usersList(Request $request) {
        $users = User::orderBy('created_at', 'DESC')->paginate($this->pagination);;
        return view('admin.userslist', ['users' => $users]);
    }

    public function userDetails(Request $request) {
        $user = User::findOrFail($request->user);
        $roles = Role::all();
        return view('admin.userdetails', ['user' => $user, 'roles' => $roles]);
    }

    public function userBlock(Request $request) {
        $user = User::findOrFail($request->user);

        $role = Role::where('role', 'blocked')->first();
        if ($role && !$user->hasRole($role->role)) {
            $user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return back()->with(
            'success',
            "User {$user->id} has been blocked successfully"
        );
    }

    public function userAddRole(Request $request) {
        $user = User::findOrFail($request->user);
        if ($user->hasRole('admin')){
            abort(403, 'Admin users can not be modified.');
        }
        $role = Role::where('id', $request['role'])->first();
        if ($role && !$user->hasRole($role->role)) {
            $user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return back()->with(
            'success',
            "User {$user->id} added role {$role->role} successfully"
        );
    }

    public function userDeleteRole(Request $request) {
        $user = User::findOrFail($request->user);
        if ($user->hasRole('admin')){
            abort(403, 'Admin users can not be modified.');
        }
        $role = Role::where('id', $request['role'])->first();
        
        if ($role && $user->hasRole($role->role)) {
            $user->roles()->detach($role->id);
        }
        
        return back()->with(
            'success',
            "User {$user->id} removed role {$role->role} successfully"
        );
    }
}
