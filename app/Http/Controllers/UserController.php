<?php

/* namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => true]);
        return back()->with('success', 'User blocked successfully');
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => false]);
        return back()->with('success', 'User unblocked successfully');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'User role updated successfully');
    }
} */

?>