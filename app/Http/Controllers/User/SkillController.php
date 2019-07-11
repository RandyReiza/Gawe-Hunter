<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\User;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        // masukkan data skill ke DB
        Skill::create($request->all());

        // cari skill berdasarkan user yang dipilih
        $skill = User::find($request->user_id)->skill->sortBy('created_at');

        // buat view yg berupa String karena d casting (String), untuk dimasukkan k json yg akan d pass k view list-skill
        $view = (string) view('user.list-skill')
            ->with('skill', $skill)
            ->render();

        // return json yg berisi view & status 
        return response()->json(['view' => $view, 'status' => 'success']);
    }
}
