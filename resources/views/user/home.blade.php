@extends('layouts.app')

@section('content')

@forelse (Auth::user()->jobs as $job)
    {{ $job->title }} <br>
    {{ $job->place }} <br>
    {{ $job->description }} <br>
    {{ $job->pivot->description }} <br> 
    {{ $job->pivot->status }} <br>
    <hr>
@empty
    --- Anda belum melamar pekerjaan ---
@endforelse



<div class="card mt-5 mb-3">
    <div class="card-body">
        This is some text within a card body.
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as {{ $role }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
