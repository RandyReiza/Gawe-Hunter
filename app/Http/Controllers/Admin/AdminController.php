<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Job;
use App\Application;
use Illuminate\Support\Facades\Response;

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


    // accept application
    public function accept(Request $request)
    {
        // ambil catatan penerimaan
        $note = $request->note;

        // update application sesuai dgn id yg dipilih ke DB
        Application::find($request->application_id)->update(['status' => 'Accept', 'note' => $note]);

        return redirect()->route('admin-home');
    }

    // reject application
    public function reject(Request $request)
    {
        // ambil catatan penerimaan
        $note = $request->note;

        // update application sesuai dgn id yg dipilih ke DB
        Application::find($request->application_id)->update(['status' => 'Reject', 'note' => $note]);

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
