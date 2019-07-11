<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home')->with('role', Auth::user()->name);
    }

    // list users
    public function list_users()
    {
        $user = User::paginate(5);
        return view('admin.users', compact('user'));
    }
}
