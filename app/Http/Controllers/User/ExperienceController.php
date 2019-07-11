<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Experience;
use App\User;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        // masukkan data skill ke DB
        Experience::create($request->all());

        // cari skill berdasarkan user yang dipilih
        $exp = User::find($request->user_id)->experience->sortBy('created_at');

        // buat view yg berupa String karena d casting (String), untuk dimasukkan k json yg akan d pass k view list-skill
        $view = (string) view('user.list-experience')
            ->with('exp', $exp)
            ->render();

        // return json yg berisi view & status 
        return response()->json(['view' => $view, 'status' => 'success']);
    }
}
