<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home')->with('role', Auth::user()->name);
    }

    public function show()
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;

        // cari user dgn id yg dipilih
        $user = User::find($user_id);

        return view('user.profile')->with('user', $user);
    }

    public function edit()
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;

        // cari user dgn id yg dipilih
        $user = User::find($user_id);

        return view('user.edit')->with('user', $user);
    }


    public function update(UserRequest $request)
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;

        if (isset($request->password)) {
            $password = bcrypt($request->password);
        } elseif (!isset($request->password)) {
            $password = Auth::user()->password;
        }
        // data article di masukkan k array
        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
        ];


        // update article sesuai dgn id yg dipilih ke DB
        User::find($user_id)->update($data_user);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses mengupdate Data Profile");
        Session::flash("alert", "warning");

        return redirect()->route('user.profile');
    }
}
