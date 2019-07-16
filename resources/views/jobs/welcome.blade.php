@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'GAWE HUNTER')

@section('content')

{{-- alert -->> by Toastr.js --}}
@if (Session::has('alert'))
    <script>
        window.onload = function() {
            toastr_alert("{{ Session::get('alert') }}", "{{ Session::get('message') }}", "{{ Session::get('status') }}")
        }
    </script>
@endif

{{-- PAGE CONTENT --}}
<div class="row mt-4">
    {{-- <div col-6>

    </div> --}}
    <div class="col-3">
        <h2>Daftar Pekerjaan</h2>
    </div>
    <div class="col-5">
        @auth
            @if (Auth::user()->hasRole('Admin'))
                <div class="row-9">
                    <a href="{{ route('job.create') }}" class="btn btn-raised btn-dark">Buat Pekerjaan</a>
                </div>    
            @endif
        @endauth
    </div>
    <div class="col-4">
        <input type="search" class="form-control" placeholder="Cari Pekerjaan ..." aria-label="Search" id="search-input">
    </div>
</div>
<hr>
<div id="list-job">
    @include('jobs.list-job')
</div>

<div class="mb-3"></div>
@endsection