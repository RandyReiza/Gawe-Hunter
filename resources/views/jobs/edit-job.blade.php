@extends('layouts.app')

@section('title', 'GAWE HUNTER - Edit Pekerjaan "' . $job->title . '"')

@section('content')
    <h3>Edit Pekerjaan</h3>
    <form action="{{ route('job.update', $job->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Judul Pekerjaan" value="{{ $job->title }}">
            @if($errors->has('title'))
                <div class="text-danger">
                {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="place" name="place" placeholder="Tempat Pekerjaan" value="{{ $job->place }}">
            @if($errors->has('place'))
                <div class="text-danger">
                {{ $errors->first('place') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <textarea name="description" id="textarea" cols="30" rows="10" class="form-control" placeholder="Deskripsi Pekerjaan">{{ $job->description }}</textarea>
            @if($errors->has('description'))
                <div class="text-danger">
                {{ $errors->first('description') }}
                </div>
            @endif
        </div>
        
        <hr>

        <div class="form-group pull-right">
            <input type="submit" value="Ubah Pekerjaan" class="btn btn-warning" onclick="return confirm('Anda yakin dengan data yang anda masukkan?')">
        </div>
    </form>
@endsection