@extends('layouts.app')

@section('title', 'Edit Profile "' . $user->name . '"')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h2>Edit Profile</h2>

                <div class="panel-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nama" required>

                                @if($errors->has('name'))
                                    <div class="text-danger">
                                    {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email" required>

                                @if($errors->has('email'))
                                    <div class="text-danger">
                                    {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{-- <div class="col text-danger"><sub>*Kosongkan kolom password bila tidak ingin mengubah password</sub></div> --}}
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" title="*Kosongkan kolom password bila tidak ingin mengubah password">

                                @if($errors->has('password'))
                                    <div class="text-danger">
                                    {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <div class="input-group row col-7">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input id="datepicker" type="text" class="form-control" name="tgl_lahir" value="{{ date("d-m-Y", strtotime($user->tgl_lahir)) }}" placeholder="Tanggal Lahir" style="width:100px;" required readonly>
                                </div>
                                @if($errors->has('tgl_lahir'))
                                    <div class="text-danger">
                                    {{ $errors->first('tgl_lahir') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <input type="submit" value="Ubah Profile" class="btn btn-warning">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection