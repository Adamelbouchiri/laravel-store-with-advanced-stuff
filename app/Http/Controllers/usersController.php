<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userRole;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function index() {
        $users = User::all();
        return view("users.showUsers", compact("users"));
    }

    public function trashedUsers() {
        $users = User::onlyTrashed()->get();
        return view("users.trashedUsers", compact("users"));
    }

    public function update(Request $request, User $user)
    {
        if($user->id == 1) {
            return redirect()->route("users.show")->with("error",  "You cannot Moderate the admin");
        }

        $userRole = userRole::find($user->id);
        
        $userRole->role_id = 2;
        $userRole->save();

        return redirect()->route("users.show")->with("success",  "User role updated successfully");
    }

    public function destroy(User $user)
    {
        // dd($user);
        if($user->id == 1) {
            return redirect()->route("users.show")->with("error",  "You cannot delete the admin");
        }

        $user->delete();
        return redirect()->route("users.show")->with("success", "User Delted Successfully") ;
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('trashedUsers.show')->with('success', 'User restored successfully.');
    }
}
