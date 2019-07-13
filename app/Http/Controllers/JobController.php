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
    public function index()
    {
        // ambil data dr table job
        $jobs = Job::orderBy('created_at', 'DESC')->paginate(5);

        return view('jobs.welcome')
            ->with('jobs', $jobs);
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
        // cari article dgn id yg dipilih
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
        Job::destroy($job->id);

        // tampilkan pesan ke view
        Session::flash("message", "Sukses menghapus Artikel");
        Session::flash("alert", "error");
        Session::flash("status", "Terhapus");

        return redirect()->route('job.index');
    }
}
