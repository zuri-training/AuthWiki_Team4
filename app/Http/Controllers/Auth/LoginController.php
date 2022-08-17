<?php

namespace App\Http\Controllers\Auth;

use App\{
    Http\Controllers\Controller,
    Providers\RouteServiceProvider,
    Models\User,
    Models\File
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
        return 'login';
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
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), true
        );
    }
    protected function authenticated(Request $request, $user)
    {
        return Redirect::intended($this->redirectTo);
    }

    public function gitHubLogin()
    {
        $provider = Socialite::driver('github')->user();
        $user = User::firstOrCreate(
            [
                'email' => Str::lower($provider->getEmail())
            ],
            [
                'name' => $provider->getName(),
                'user_name' => Str::words($provider->getNickname(), 1, '').'_'.Str::random(8),
                'photo' => $provider->getAvatar(),
                'password' => Str::random(8),
                'github_id' => $provider->getId(),
                'email_verified_at' => now(),
                'password_changed' => 0
            ]
        );
        if($user->github_id == null) {
            $user->update([
                'github_id' => $provider->getId()
            ]);
        }
        Auth::loginUsingId($user->id, true);
        return redirect(RouteServiceProvider::HOME);
    }
    public function googleLogin()
    {
        $provider = Socialite::driver('google')->user();
        $user = User::firstOrCreate(
            [
                'email' => Str::lower($provider->getEmail())
            ],
            [
                'name' => $provider->getName(),
                'user_name' => Str::words($provider->getNickname(), 1, '').'_'.Str::random(8),
                'photo' => $provider->getAvatar(),
                'password' => Str::random(8),
                'google_id' => $provider->getId(),
                'email_verified_at' => now(),
                'password_changed' => 0
            ]
        );
        if($user->google_id == null) {
            $user->update([
                'google_id' => $provider->getId()
            ]);
        }
        Auth::loginUsingId($user->id, true);
        return redirect(RouteServiceProvider::HOME);
    }
    public function redirectGitHub() {
        return Socialite::driver('github')->redirect();
    }
    public function redirectGoogle() {
        return Socialite::driver('google')->redirect();
    }
}
