@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'List Users')

@section('content')
    <h2>List Users</h1>
    {{-- <div class="card-body">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="file" class="form-control" required>
            <br>
            <button class="btn btn-success">Import User Data</button>
            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
            <a class="btn btn-dark" href="{{ route('exportPDF') }}">Export User Data [PDF Version]</a>
        </form>
    </div> --}}

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user as $key => $u)
            <tr>
                <th>{{ ++$key }}</td>
                <td>{{ $u->name }}</td>
                <td><a href="mailto:{{ $u->email }}">{{ $u->email }}</a></td>
                <td>@datetime($u->tgl_lahir)</td>
                @foreach ($u->roles as $role)
                    <td>{{ $role->name }}</td>
                @endforeach
                <td> <a class="btn btn-primary" href="/sendEmail/{{ $u->email }}">Send E-mail</a> </td>
            </tr>             
            @empty
            <tr>
                <th class="text-center" colspan="4">-- Tidak ada Data --</th>
            </tr>    
            @endforelse
        </tbody>
    </table>
    
    {{-- buat jarak ke footer (biar gk ketutupan footer) --}}
    <div class="mb-5 d-flex justify-content-center">
        {{-- !!! pagination !!! --}}
        {{ $user->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endsection
    
    @section('foot')
    <p>Footernya Users</p>
    @endsection