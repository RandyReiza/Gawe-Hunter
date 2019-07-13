@extends('layouts.app')

@section('title', 'Job App - Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h2>Register</h2>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama" required autofocus>

                                @if($errors->has('name'))
                                    <div class="text-danger">
                                    {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if($errors->has('email'))
                                    <div class="text-danger">
                                    {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if($errors->has('password'))
                                    <div class="text-danger">
                                    {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>

                                @if($errors->has('password-confirm'))
                                    <div class="text-danger">
                                    {{ $errors->first('password-confirm') }}
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
                                    <input id="datepicker" type="text" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Tanggal Lahir" required readonly>
                                </div>
                                @if($errors->has('tgl_lahir'))
                                    <div class="text-danger">
                                    {{ $errors->first('tgl_lahir') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
