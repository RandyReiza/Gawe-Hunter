@extends('layouts.app')

@section('title', $job->title)

@section('content')

{{-- alert -->> by Toastr.js --}}
@if (Session::has('alert'))
    <script>
        window.onload = function() {
            toastr_alert("{{ Session::get('alert') }}", "{{ Session::get('message') }}", "{{ Session::get('status') }}")
            swal("{{ Session::get('status') }}", "{{ Session::get('message') }}", "{{ Session::get('alert') }}");
        }
    </script>
@else

@endif

{{-- PAGE CONTENT --}}
<h2 class="row">{!! $job->title !!}</h2>

<hr style="border: 1px solid black; border-radius: 1px;">
{{-- artikel content --}}
<div>{!! $job->description !!}</div>
<hr style="border: 1px solid black; border-radius: 1px;">

{{-- Tombol Aksi untuk Artikel --}}
<div class="mt-3">
    <form action="{{ route('job.destroy', $job->id) }}" method="POST">
        <a href="{{ route('job.index') }}" class="btn btn-dark">&#x2B05;Back</a> 

        @auth
            @if (Auth::user()->hasRole('Admin'))
                <a href="{{ route('job.edit', $job->id) }}" class="btn btn-warning">Edit</a> 
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger pull-right" onclick="return confirm('Anda yakin pekerjaan ini akan dihapus?')">Delete</button>
            @endif
        @endauth
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-info pull-right">Silahkan daftar untuk Apply Job !</a> 
        @endguest
    </form>

    @auth
        @if (Auth::user()->hasRole('User'))
            @if (Auth::user()->jobs->find($job->id))
                <button type="submit" class="btn btn-outline-primary pull-right" id="btn-show-kolom-apply" disabled>Sudah Pernah Apply!</button>
            @else
                <button type="submit" class="btn btn-outline-primary pull-right" id="btn-show-kolom-apply">Apply!</button>
                <br>
                <br>
            @endif
        @endif
    @endauth

    {{-- Kolom alasan ingin Apply {defaultnya sengaja di 'style display: none' supaya ke hidden -->> lalu d klik tombol apply & dimunculin id="kolom-apply" pake JS} --}}
    <div class="mt-3" id="kolom-apply" style="display: none;">
        @if (isset(Auth::user()->cv->file))
            <hr style="border: 1px solid black; border-radius: 1px;">
            <h5 class="row col"><i>Apa yang membuat anda tertarik dengan perusahaan kami:</i></h5>
            <div class="mt-3">
                <form action="{{ route('apply') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="job_id" name="job_id" value="{{ $job->id }}">
                    <div class="form-group">
                        <textarea name="description" id="textarea" cols="30" rows="10" class="form-control" placeholder="Apa yang membuat anda tertarik dengan perusahaan kami"></textarea>
                        @if($errors->has('description'))
                            <div class="text-danger">
                            {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" value="Apply!" class="btn btn-dark" id="btn-apply" onclick="return confirm('Anda yakin akan melamar ke pekerjaan ini?')">
                    </div>
                </form>
            </div>
        @else
            <hr style="border: 1px solid black; border-radius: 1px;">
            <h4>Anda belum upload CV, silahkan Upload CV terlebih dahulu</h4>
            <a href="{{ url('profile') }}" class="btn btn-success">Upload CV</a> 
        @endif
    </div>
</div>
@endsection