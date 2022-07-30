<?php

namespace App\Http\Controllers\Auth;

use App\{
    Http\Controllers\Controller,
    Providers\RouteServiceProvider,
    Models\Github,
    Models\Google,
    Models\User
};
use Illuminate\{
    Http\Request,
    Foundation\Auth\AuthenticatesUsers,
    Support\Facades\Redirect,
    Support\Str,
    Support\Facades\Auth
};
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'login_id';
    }
    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        $credentials = [
            $fieldType => Str::lower($login),
            'password' => $request->input('password')
        ];

        return $credentials;
    }
    protected function authenticated(Request $request, $user)
    {
        return Redirect::intended($this->redirectTo);
    }

    public function gitHubLogin()
    {
        $_user = Socialite::driver('github')->user();
        $user = User::where('email', $_user->getEmail());
        $github = Github::where('github_id', $_user->getId());
        if($user->exists() && $github->exists() && $github->first()->users_id <> $user->first()->id) {
            return redirect()->to(route('login', [
                'error' => 'A user with this email already exist. Login first, then connect your Github account to your profile'
            ]));
        } else {
            if($user->doesntExist()) {
                $user = User::create([
                    'name' => $_user->getName(),
                    'user_name' => Str::words($_user->getNickname(), 1, '#').Str::random(8),
                    'email' => $_user->getEmail(),
                    'photo' => $_user->getAvatar(),
                    'password' => Str::random(8),
                ]);
                $uid = $user->id;
            } else {
                $uid = $user->first()->id;
            }
            Github::updateOrCreate(
                ['github_id' => $_user->getId()],
                [
                    'users_id' => $uid,
                    'github_token' => $_user->token,
                    'github_refresh_token' => $_user->refreshToken
                ]
            );
            Auth::loginUsingId($uid);
            return redirect(RouteServiceProvider::HOME);
        }
    }
    public function googleLogin()
    {
        $_user = Socialite::driver('google')->user();
        $user = User::where('email', $_user->getEmail());
        $google = Google::where('google_id', $_user->getId());
        if($user->exists() && $google->exists() && $google->first()->users_id <> $user->first()->id) {
            return redirect()->to(route('login', [
                'error' => 'A user with this email already exist. Login first, then connect your Google account to your profile'
            ]));
        } else {
            if($user->doesntExist()) {
                $user = User::create([
                    'name' => $_user->getName(),
                    'user_name' => Str::words($_user->getNickname(), 1, '#').Str::random(8),
                    'email' => $_user->getEmail(),
                    'photo' => $_user->getAvatar(),
                    'password' => Str::random(8),
                ]);
                $uid = $user->id;
            } else {
                $uid = $user->first()->id;
            }
            Google::updateOrCreate(
                ['google_id' => $_user->getId()],
                [
                    'users_id' => $uid,
                    'google_token' => $_user->token,
                    'google_refresh_token' => $_user->refreshToken
                ]
            );
            Auth::loginUsingId($uid);
            return redirect(RouteServiceProvider::HOME);
        }
    }
    public function redirectGitHub() {
        return Socialite::driver('github')->redirect();
    }
    public function redirectGoogle() {
        return Socialite::driver('google')->redirect();
    }
}
