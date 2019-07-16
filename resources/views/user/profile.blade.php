@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'GAWE HUNTER - Profile User')

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
<div class="row-3 mr-3">
    <h2>Profile User</h2>
</div>
<hr>
{{-- row ke 1 --}}
<div class="row mb-5">
    {{-- Indentitas User --}}
    <div class="col-6">
        <div class="card bg-light">
            <div class="card-body">
                <h3>Indentitas User</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><h6>Nama</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6>{{ $user->name }}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Email</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6>{{ $user->email }}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Tanggal Lahir</h6></td>
                            <td><h6>:</h6></td>
                            <td><h6>@datetime($user->tgl_lahir)</h6></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col mt-1">
                    <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#modal-ubah-profil">Ubah Profil</button>
                </div>
            </div>
        </div>
        {{-- Modal Ubah Profil --}}
        <div class="modal fade" id="modal-ubah-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" title="*Kosongkan kolom password bila tidak ingin mengubah password">
                    </div>
                    <div class="input-group row col-7">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input id="datepicker" type="text" class="form-control" name="tgl_lahir" value="{{ date("d-m-Y", strtotime($user->tgl_lahir)) }}" placeholder="Tanggal Lahir" style="width:100px;" required readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Anda yakin dengan data yang anda masukkan?')">Ubah Profil</button>
                </div>
            </form>                                                    
            </div>
        </div>
        </div>
    </div>

    {{-- CV --}}
    <div class="col-6">
        <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->cv->file)) border-danger animated infinite pulse @endif " id="cv">
            <div class="card-body">
                <h3>Curriculum vitae</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama File</td>
                            <td>:</td>
                            <td>
                                @if (isset($user->cv->file))
                                    {{-- output nama file CV --}}
                                    {{ substr($user->cv->file, strpos($user->cv->file, "_") + 1) }}
                                @else
                                    Anda belum Upload CV, silahkan Upload !
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if (isset($user->cv->file))
                            <td colspan="3">
                                {{-- button download CV --}}
                                <form action="{{ url('downloadCV') }}" method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                    <button type="submit" class="btn btn-outline-success">Download CV</button>
                                </form>
                            </td>    
                            @else
                            <td colspan="3">
                                <form action="{{ route('store-CV') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" id="cv-img" name="cv-img">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Upload" class="btn btn-success">
                                    </div>
                                </form>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- row ke 2 --}}
<div class="row mb-5">
    {{-- Keterampilan --}}
    <div class="col-6">
        <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->skill[0]->skill)) border-danger animated infinite pulse @endif " id="skill">
            <div class="card-body">
                <h3 id="keterampilan">Keterampilan</h3>
                <table class="table table-hover">
                    <tbody class="text-center" id="list-skill">
                        @include('user.list-skill')
                    </tbody>
                </table>
                <table class="table table-responsive">
                    <tbody class="text-center">
                        <tr>
                            <form method="POST" id="form-skill">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <td width="150px" style="text-align: center; vertical-align: middle">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="skill" name="skill" placeholder="Kemampuan" value="{{ old('skill') }}">
                                        @if($errors->has('skill'))
                                            <div class="text-danger">
                                            {{ $errors->first('skill') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="level" name="level">
                                            <option value="Pemula">Pemula</option>
                                            <option value="Menengah">Menengah</option>
                                            <option value="Tingkat Lanjutan">Tingkat Lanjutan</option>
                                        </select>
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <div class="form-group">
                                        <button class="btn btn-outline-success" id="btn-skill">Submit</button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pengalaman --}}
    <div class="col-6">
        <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->experience[0]->experience)) border-danger animated infinite pulse @endif " id="experience">
            <div class="card-body">
                <h3 id="pengalaman">Pengalaman Kerja</h3>
                <table class="table table-hover">
                    <tbody id="list-experience">
                        @include('user.list-experience')
                    </tbody>
                </table>
                <table class="table table-responsive">
                    <tbody class="text-center">
                        <tr>
                            <form method="POST" id="form-experience">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="experience" name="experience" placeholder="Pengalaman Kerja" value="{{ old('experience') }}">
                                        @if($errors->has('experience'))
                                            <div class="text-danger">
                                            {{ $errors->first('experience') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button class="btn btn-outline-success" id="btn-experience">Submit</button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection