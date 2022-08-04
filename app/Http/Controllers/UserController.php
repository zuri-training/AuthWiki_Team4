<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->only(['toggleCrown', 'destroy']);
    }
    public function index()
    {
        $user = User::paginate(15);
        return view('user.index', compact('user'));
    }
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
    public function toggleCrown(User $user)
    {
        if($user->id > 1) {
            $user->update([
                'admin' => $user->admin ? 0 : 1
            ]);
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
    }
}
