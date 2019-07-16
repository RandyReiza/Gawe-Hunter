<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\User;
use Illuminate\Support\Facades\Session;

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

        // tampilkan pesan ke view
        Session::flash("message", "Sukses menambah Keterampilan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        // return json yg berisi view & status 
        return response()->json(['view' => $view, 'status' => 'success']);
    }

    public function destroy(Skill $skill)
    {
        // delete job dgn id yg dipilih
        Skill::destroy($skill->id);

        // tampilkan pesan ke view
        Session::flash("message", "Keterampilan telah terhapus");
        Session::flash("alert", "error");
        Session::flash("status", "Terhapus");

        return redirect('profile#keterampilan');
    }
}
