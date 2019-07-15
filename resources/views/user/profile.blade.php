@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'Profile User')

@section('content')
    <h1>Profile User</h1>

    <div class="container">
        {{-- row ke 1 --}}
        <div class="row mb-5">
            <div class="col-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h3> <u>Indentitas User</u> </h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><h5>Nama</h5></td>
                                    <td><h5>:</h5></td>
                                    <td><h5>{{ $user->name }}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Email</h5></td>
                                    <td><h5>:</h5></td>
                                    <td><h5>{{ $user->email }}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Tanggal Lahir</h5></td>
                                    <td><h5>:</h5></td>
                                    <td> <h5>@datetime($user->tgl_lahir)</h5></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col mt-1">
                            <a class="btn btn-outline-success" href="{{ route('user.edit', $user->id) }}">Ubah Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->cv->file)) border-danger animated infinite bounce @endif " id="cv">
                    <div class="card-body">
                        <h3> <u>Curriculum vitae</u> </h3>
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
        <div class="row">
            <div class="col-6">
                <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->skill[0]->skill)) border-danger animated infinite bounce @endif " id="skill">
                    <div class="card-body">
                        <h3> <u>Keterampilan</u> </h3>
                        <table class="table">
                            <tbody class="text-center" id="list-skill">
                                @include('user.list-skill')
                            </tbody>
                        </table>
                        <table>
                            <tbody class="text-center">
                                <tr>
                                    <form method="POST" id="form-skill">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="Kemampuan" value="{{ old('skill') }}">
                                                @if($errors->has('skill'))
                                                    <div class="text-danger">
                                                    {{ $errors->first('skill') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" id="level" name="level">
                                                    <option value="Pemula">Pemula</option>
                                                    <option value="Menengah">Menengah</option>
                                                    <option value="Tingkat Lanjutan">Tingkat Lanjutan</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-dark" id="btn-skill">Submit</button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card bg-light @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'job.show' && empty($user->experience[0]->experience)) border-danger animated infinite bounce @endif " id="experience">
                    <div class="card-body">
                        <h3> <u>Pengalaman Kerja</u> </h3>
                        <table class="table">
                            <tbody id="list-experience">
                                @include('user.list-experience')
                            </tbody>
                        </table>
                        <table>
                            <tbody class="text-center">
                                <tr>
                                    <form method="POST" id="form-experience">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
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
                                            <button class="btn btn-dark" id="btn-experience">Submit</button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection