@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'GAWE HUNTER - List Users')

@section('content')

<div class="row-3 mr-3">
    <h2>List Users</h2>
</div>
<hr> 

<div class="card bg-light">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="50px" style="text-align: center; vertical-align: middle">No.</th>
                    <th style="text-align: center; vertical-align: middle">Nama</th>
                    <th style="text-align: center; vertical-align: middle">Email</th>
                    <th style="text-align: center; vertical-align: middle">Tanggal Lahir</th>
                    <th style="text-align: center; vertical-align: middle">Role</th>
                    <th style="text-align: center; vertical-align: middle">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $key => $u)
                <tr>
                    <td style="text-align: center; vertical-align: middle"><strong>{{ ++$key }}</strong></td>
                    <td style="text-align: center; vertical-align: middle">{{ $u->name }}</td>
                    <td style="text-align: center; vertical-align: middle"><a href="mailto:{{ $u->email }}">{{ $u->email }}</a></td>
                    <td style="text-align: center; vertical-align: middle">@datetime($u->tgl_lahir)</td>
                    @foreach ($u->roles as $role)
                        <td width="50px" style="text-align: center; vertical-align: middle">
                            @if ($role->name == "Admin")
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @else
                                <span class="badge badge-warning">{{ $role->name }}</span>
                            @endif
                        </td>
                    @endforeach
                    @if ($role->name == "User")
                        <form method="POST" action="{{ route('destroy-users') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $u->id }}">
                            <td width="10px" style="text-align: center; vertical-align: middle">
                                <small><button style="font-size: smaller" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin akan menghapus user ini?')"><i class="icon fa fa-times"></i></button></small>
                            </td>
                        </form>
                    @endif
                </tr>             
                @empty
                <tr>
                    <th class="text-center" colspan="4">-- Tidak ada Data --</th>
                </tr>    
                @endforelse
            </tbody>
        </table>
    </div>
</div>



{{-- buat jarak ke footer (biar gk ketutupan footer) --}}
<div class="mb-5 d-flex justify-content-center">
    {{-- !!! pagination !!! --}}
    {{ $user->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection