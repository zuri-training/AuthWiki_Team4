<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    File
};
use Illuminate\{
    Http\Request,
    Support\Str,
    Support\Arr,
    Support\Facades\Validator,
    Support\Facades\Storage,
    Validation\Rules\Password,
    Support\Facades\Auth,
    Support\Facades\Hash
};
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showUserProfile', 'subscribe', 'unsubscribe']);
        $this->middleware('isAdmin')->only(['toggleCrown', 'showAll']);
    }
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function updateProfile(Request $request) {
        $user = Auth::user();
        $fields = array();
        $fields[] = ['name' => 'required|string|between:5,250'];
        $fields[] = ['website' => 'nullable|string|max:250|unique:users,website,'.$user->id];
        $fields[] = ['twitter' => 'nullable|string|max:50|unique:users,twitter,'.$user->id];
        $fields[] = ['github' => 'nullable|string|max:50|unique:users,github,'.$user->id];
        if($user->email_verified_at == null) {
            $fields[] = ['email' => 'required|string|email|max:250|unique:users,email,'.$user->id];
        }
        if(!$user->password_changed) {
            $fields[] = ['user_name' => 'required|string|between:5,20|unique:users,user_name,'.$user->id];
        }
        $validator = Validator::make($request->all(), Arr::collapse($fields));
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        User::find($user->id)->update($validator->validated());
        return back()->with('profile', 'yes');
    }
    public function updatePassword(Request $request) {
        $user = Auth::user();
        if(!$user->password_changed) {
            if($request->has('password_old')) {
                if(!Hash::check($request->password_old, $user->password)) {
                    return back()->with('error', 'Old password is not correct');
                }
            } else {
                return back()->with('error', 'Old password is required');
            }
        }
        $fields[] = ['password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()->symbols()]];
        $validator = Validator::make($request->all(), Arr::collapse($fields));
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        User::find($user->id)->update([
            'password_changed' => 1,
            'password' => $request->password
        ]);
        return back();
    }
    public function changeAvatar(Request $request){
        $request->validate([
          'avatar' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($request->file()) {
            $id = Auth::id();
            $file = $request->file('avatar')->storePubliclyAs(
                "user_$id",
                'avatar.'.$request->file('avatar')->getClientOriginalExtension(),
                'public'
            );
            $dir = File::updateOrCreate([
                'user_id' => $id,
                'name' => 'avatar'
            ], [
                'path' => 'storage/'.$file
            ]);
            User::find($id)->update([
                'photo' => $dir->path
            ]);
            return back()->with('success','Avatar updated.');
        }
    }
    public function resetAvatar() {
        $id = Auth::id();
        if($del = File::where(['user_id' => $id, 'name' => 'avatar'])->first()) {
            Storage::disk('public')->delete($del->path);
            $del->delete();
        }            
        User::find($id)
            ->update([
                'photo' => 'images/team/default.png'
            ]);
        return back();
    }
    public function deleteProfile()
    {
        $user = Auth::user();
        Storage::disk('public')->deleteDirectory("user_{$user->id}");
        User::find($user->id)->delete();
        return redirect()
            ->to(route('index'))
            ->with('warning', 'Goodbye!');
    }
    public function showAll()
    {
        $user = User::paginate(15);
        return view('user.index', compact('user'));
    }
    public function settings() {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }
    public function tos(Request $request) {
        if($request->has('decision')) {
            if($request->decision == 'accept') {
                session(['info' => 'Terms of service accepted']);
            } else {
                session(['error' => 'Terms of service not accepted']);
            }
            $request->session()->forget('tos');
        } else {
            session(['tos' => true]);
        }
    }
    public function showUserProfile(User $user)
    {
        return view('profile.user', compact('user'));
    }
    public function toggleCrown(User $user)
    {
        if($user->id > 1) {
            $user->update([
                'admin' => $user->admin ? 0 : 1
            ]);
        }
        return $user;
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $email = Str::lower($request->email);
        $user = User::where('email', $email);
        $name = [];
        if($user->exists()) {
            $name = [
                'FNAME' => Str::words($user->first()->name, 1, '')
            ];
        }
        if(!(Newsletter::hasMember($email) && Newsletter::isSubscribed($email))) {
            Newsletter::subscribe($email, $name);
            return back()->with('success', 'Subscribed');
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
