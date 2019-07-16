<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Job;
use App\Application;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function home()
    {
        // cari lamaran yg statusnya Unread
        $job_unread = Job::whereHas('users', function ($j) {
            $j->where('status', 'Unread');
        })->get();

        // cari lamaran yg statusnya Accept
        $job_accept = Job::whereHas('users', function ($j) {
            $j->where('status', 'Accept');
        })->get();

        // cari lamaran yg statusnya Reject
        $job_reject = Job::whereHas('users', function ($j) {
            $j->where('status', 'Reject');
        })->get();

        return view('admin.home')
            ->with('role', Auth::user()->name)
            ->with('job_unread', $job_unread)
            ->with('job_accept', $job_accept)
            ->with('job_reject', $job_reject);
    }

    // list users
    public function list_users()
    {
        $user = User::paginate(5);
        return view('admin.list-users', compact('user'));
    }


    public function destroyUsers(User $user, Request $request)
    {
        // ambil user yg dipilih
        $user = User::find($request->user_id);

        // ambil user yg melamar k job yg dipilih
        $jobs = User::find($user->id)->jobs;
        if (!empty($jobs)) {
            // detach (delete) ke pivot table job_user (Model: Application)
            $user->jobs()->detach($jobs);
        }

        // delete job dgn id yg dipilih
        User::destroy($user->id);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses menghapus User");
        Session::flash("alert", "error");
        Session::flash("status", "Terhapus");

        return redirect()->route('list-users');

        // ///////////////

        // // ambil job yang dilamar
        // $job = Job::find($job->id);

        // // ambil user yg melamar k job yg dipilih
        // $users = Job::find($job->id)->users;

        // // detach (delete) ke pivot table job_user (Model: Application)
        // $job->users()->detach($users);

        // // delete job dgn id yg dipilih
        // Job::destroy($job->id);

        // // tampilkan pesan ke view
        // Session::flash("message", "Sukses menghapus Pekerjaan");
        // Session::flash("alert", "error");
        // Session::flash("status", "Terhapus");

        // return redirect()->route('job.index');
    }


    // accept application
    public function accept(Request $request)
    {
        // ambil catatan penerimaan
        $note = $request->note;

        // update application sesuai dgn id yg dipilih ke DB
        Application::find($request->application_id)->update(['status' => 'Accept', 'note' => $note]);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses Accept lamaran pekerjaan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        return redirect()->route('admin-home');
    }

    // reject application
    public function reject(Request $request)
    {
        // ambil catatan penerimaan
        $note = $request->note;

        // update application sesuai dgn id yg dipilih ke DB
        Application::find($request->application_id)->update(['status' => 'Reject', 'note' => $note]);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses Reject lamaran pekerjaan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        return redirect()->route('admin-home');
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
}
