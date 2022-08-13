<?php

namespace App\Http\Controllers\Auth;

use App\{
    Http\Controllers\Controller,
    Providers\RouteServiceProvider,
    Models\User
};
use Illuminate\{
    Foundation\Auth\RegistersUsers,
    Support\Facades\Validator,
    Validation\Rules\Password
};

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'name' => 'required|string|between:5,250',
                'user_name' => 'required|string|between:5,25|unique:users,user_name',
                'email' => 'required|string|email|max:250|unique:users,email',
                'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
