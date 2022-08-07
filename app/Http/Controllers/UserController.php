<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\{
    Http\Request,
    Support\Str,
    Support\Facades\Validator
};
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['subscribe', 'unsubscribe']);
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
        return back();
    }
    public function destroy(User $user)
    {
        $this->unSubscribe($user->email);
        $user->delete();
    }
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email'
        ]);
        if($validator->fails()) {
            return back()->with('error', 'Invalid email address');
        } else {
            $email = Str::lower($request->email);
            $user = User::where('email', $email);
            $name = [];
            if($user->exists()) {
                $name = [
                    'FNAME' => Str::words($user->first()->name, 1, '')
                ];
            }
            if(!Newsletter::hasMember($email)) {
                if(!Newsletter::isSubscribed($email)) {
                    Newsletter::subscribe($email, $name);
                    return back()->with('succes', 'Subscribed');
                }
            }
        }
        return back()->with('warning', 'Subscribed');
    }
    public function unSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $email = Str::lower($request->email);
        if(Newsletter::hasMember($email)) {
            Newsletter::unsubscribe($email);
        }
        return redirect(route('home'));
    }
}
