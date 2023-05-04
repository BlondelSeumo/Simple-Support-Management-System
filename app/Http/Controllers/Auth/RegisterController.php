<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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
        return Validator::make($data, $this->validateArray());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        $clientrole = Role::find(3);
        $user->assignRole($clientrole->name);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    private function validateArray()
    {
        return [
            'name'     => ['required', 'string', 'max:60'],
            'email'    => ['required', 'string', Rule::unique("users", "email"), 'email', 'max:100'],
            'phone'    => ['required', 'string', 'max:60'],
            'address'  => ['required', 'max:200'],
            'username' => ['required', 'string', Rule::unique("users", "username"), 'max:60'],
            'password' => ['required', 'min:6'],
        ];
    }
}
