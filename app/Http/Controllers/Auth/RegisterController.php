<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;

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
    protected $redirectTo = '/home';

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
        // Validator::extend('olderThan', function ($attribute, $value, $parameters) {
        //     $minAge = (!empty($parameters)) ? (int) $parameters[0] : 13;
        //     return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        // });

        $messages = [
            'required' => ':Attribute wajib diisi !',
            'min' => ':Attribute harus diisi minimal :min karakter !',
            'max' => ':Attribute harus diisi maksimal :max karakter !',
            'string' => ':Attribute harus berupa huruf',
            'email' => 'Penulisan :Attribute harus sesuai dengan Format Email',
            'confirmed' => 'Password & Konfirmasi password harus sama',
            'before' => 'Anda harus lebih dari 17 tahun untuk bisa mendaftar',
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tgl_lahir' => ['required', 'string', 'before:-17 years'],
        ], $messages);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'tgl_lahir' => date("Y-m-d", strtotime($data['tgl_lahir'])),
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', 'User')->first());
        return $user;
    }
}
