@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'Profile User')

@section('content')
    <h1>Profile User</h1>

    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Nama</h5>
                                    </td>
                                    <td>
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $user->name }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Email</h5>
                                    </td>
                                    <td>
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $user->email }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Tanggal Lahir</h5>
                                    </td>
                                    <td>
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>@datetime($user->tgl_lahir)</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col mt-1">
                            <a class="btn btn-dark" href="{{ route('user.edit', $user->id) }}">Ubah Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection