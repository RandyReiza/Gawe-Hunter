@extends('layouts.app')

@section('title', 'Buat Pekerjaan')

@section('content')
    <h3>Buat Pekerjaan</h3>
    <form action="{{ route('job.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Judul Pekerjaan" value="{{ old('title') }}">
            @if($errors->has('title'))
                <div class="text-danger">
                {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="place" name="place" placeholder="Tempat Pekerjaan" value="{{ old('place') }}">
            @if($errors->has('place'))
                <div class="text-danger">
                {{ $errors->first('place') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <textarea name="description" id="textarea" cols="30" rows="10" class="form-control" placeholder="Deskripsi Pekerjaan"></textarea>
            @if($errors->has('description'))
                <div class="text-danger">
                {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <hr>
        
        <div class="form-group pull-right">
            <input type="submit" value="Buat Pekejaan" class="btn btn-dark">
        </div>
    </form>
@endsection