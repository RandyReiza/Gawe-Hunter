<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // jika ada request dr ajax
        if ($request->ajax()) {
            // lakukan pencarian article berdasarkan inputan d search box
            $jobs = Job::with('users')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);

            // buat view yg berupa String karena d casting (String), untuk dimasukkan k json yg akan d pass k view list-comment
            $view = (string) view('jobs.list-job')->with('jobs', $jobs)->render();
            return response()->json(['view' => $view, 'status' => 'success']);
        } else {
            // ambil data dr table job
            $jobs = Job::orderBy('created_at', 'DESC')->paginate(5);

            return view('jobs.welcome')->with('jobs', $jobs);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create-job');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        // lakukan pengyimpanan data job
        Job::create($request->all());

        // tampilkan pesan ke view
        Session::flash("message", "Sukses Membuat Pekerjaan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        // cari job dgn id yg dipilih
        $job = Job::find($job->id);

        return view('jobs.show-job')
            ->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        // cari job dgn id yg dipilih
        $job = Job::find($job->id);

        return view('jobs.edit-job')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        // update job sesuai dgn id yg dipilih ke DB
        Job::find($job->id)->update($request->all());

        // tampilkan pesan ke view
        Session::flash("message", "Sukses mengupdate Pekerjaan");
        Session::flash("alert", "success");
        Session::flash("status", "Sukses");

        return redirect()->route('job.show', $job->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        // ambil job yang dilamar
        $job = Job::find($job->id);

        // ambil user yg melamar k job yg dipilih
        $users = Job::find($job->id)->users;

        // detach (delete) ke pivot table job_user (Model: Application)
        $job->users()->detach($users);

        // delete job dgn id yg dipilih
        Job::destroy($job->id);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses menghapus Pekerjaan");
        Session::flash("alert", "error");
        Session::flash("status", "Terhapus");

        return redirect()->route('job.index');
    }
}
