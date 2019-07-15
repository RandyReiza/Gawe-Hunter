<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;
use App\CV;
use App\Application;
use App\Job;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function show()
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;

        // cari user dgn id yg dipilih
        $user = User::find($user_id);

        // cari skill berdasarkan user
        $skill = $user->skill->sortBy('created_at');

        // cari pengalaman berdasarkan user
        $exp = $user->experience->sortBy('created_at');

        return view('user.profile')
            ->with('user', $user)
            ->with('skill', $skill)
            ->with('exp', $exp);
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
        Session::flash("status", "Warning");


        return redirect()->route('user.profile');
    }

    public function storeCV(Request $request)
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;

        // upload image
        $file = $request->file('cv-img');
        $destination_path = 'uploads/';
        $filename = str_random(6) . '_' . $file->getClientOriginalName();
        $file->move($destination_path, $filename);

        $cv = new CV();

        // save image data into database
        $cv->file = $destination_path . $filename;
        $cv->user_id = $user_id;

        // data image di masukkan k array assosiation
        $data_cv = [
            'file' => $cv->file,
            'user_id' => $cv->user_id
        ];

        // masukkan data image ke DB
        CV::create($data_cv);


        // tampilkan pesan ke view
        Session::flash("message", "Sukses mengupload CV");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        return redirect()->route('user.profile');
    }

    // download CV
    public function downloadCV(Request $request)
    {
        // ambil local addres dr filenya
        $filepath = public_path($request->file);

        // ksh nama buat filenya
        $name = substr($request->file, strpos($request->file, "_") + 1);

        // return dgn response download file tsb
        return Response::download($filepath, $name);
    }

    public function apply(Request $request)
    {
        // ambil id user yg sedang log in
        $user_id = Auth::user()->id;
        // ambil job id yang ingin dilamar
        $job_id = $request->job_id;
        // ambil deskripsi dari application {alasan melamar}
        $description = $request->description;
        // set status ke 'Unread'
        $status = 'Unread';
        // set note ke ''
        $note = '';

        // ambil user yang melamar
        $user = User::find($user_id);
        // ambil job yang dilamar
        $job = Job::find($job_id);

        // attach (insert) ke table job_user (Model: Application)
        $user->jobs()->attach($job, ['description' => $description, 'status' => $status, 'note' => $note]);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses Melamar Pekerjaan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        // // redirect ke route job.index
        return redirect()->route('job.index');
    }
}
