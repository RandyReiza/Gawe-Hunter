<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Job;
use App\Application;

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
    public function accept($id)
    {
        // update application sesuai dgn id yg dipilih ke DB
        Application::find($id)->update(['status' => 'Accept']);

        return redirect()->route('admin-home');
    }

    // reject application
    public function reject($id)
    {
        // update application sesuai dgn id yg dipilih ke DB
        Application::find($id)->update(['status' => 'Reject']);

        return redirect()->route('admin-home');
    }
}
