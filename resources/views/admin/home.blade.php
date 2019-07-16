@extends('layouts.app')

@section('content')

@section('title', 'GAWE HUNTER - Dashboard Admin')


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
    <h2>Daftar Lamaran Pekerjaan</h2>
</div>
<hr>


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="unread-tab" data-toggle="tab" href="#unread" role="tab" aria-controls="unread" aria-selected="true"><strong>Unread</strong></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="accept-tab" data-toggle="tab" href="#accept" role="tab" aria-controls="accept" aria-selected="false"><strong>Accept</strong></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false"><strong>Reject</strong></a>
    </li>
</ul>
<div class="tab-content mb-3" id="myTabContent">
    {{-- UNREAD --}}
    <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">
        <div class="card bg-light border-top-0">
            <div class="card-body pb-1">
                @forelse($job_unread as $key1 => $job)
                    <div class="mt-3">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a id="black" style="text-decoration:none;" href="#collapseCard-{{$key1}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                <h5 class="m-0 font-weight-bold">{{ $job->title }}</h5>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCard-{{$key1}}">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle">Pelamar</th>
                                            <th style="text-align: center; vertical-align: middle">Keterangan</th>
                                            <th style="text-align: center; vertical-align: middle">Status</th>
                                            <th style="text-align: center; vertical-align: middle">Detail Lamaran</th>
                                            <th style="text-align: center; vertical-align: middle">Action</th>
                                        </tr>
                                        @foreach($job->users as $key2 => $user)
                                        @if ($user->pivot->status == "Unread")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    <a data-toggle="modal" data-target="#detail-user-{{$key1}}{{$key2}}" id="detail-user-{{$key1}}{{$key2}}">{{ $user->name }}</a>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 150) !!}
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-warning">{!! $user->pivot->status !!}</span>
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">          
                                                    <small><button type="button" data-toggle="modal" data-target="#detail-lamaran-{{$key1}}{{$key2}}" class="btn btn-outline-primary" style="font-size: smaller" id="detail-lamaran-{{$key1}}{{$key2}}">Detail</button></small>
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">
                                                    <small><button style="font-size: smaller" class="btn btn-success btn-sm" title="Accept" type="button" data-toggle="modal" data-target="#modal-accept-{{$key1}}{{$key2}}"><i class="icon fa fa-check"></i></button></small>
                                                    <small><button style="font-size: smaller" class="btn btn-danger btn-sm" title="Reject" type="button" data-toggle="modal" data-target="#modal-reject-{{$key1}}{{$key2}}"><i class="icon fa fa-times"></i></button></small>
                                                </td>
                                            </tr>

                                            {{-- Modal Detail User --}}
                                            <div class="modal fade " id="detail-user-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="detail-user-{{$key1}}{{$key2}}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detail-user-{{$key1}}{{$key2}}">Detail User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Detail Lamaran --}}
                                            <div class="modal fade" id="detail-lamaran-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Detail Lamaran</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Pekerjaan :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Nama Pekerjaan</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->title }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tempat</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->place }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Deskripsi </h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <a href="{{ route('job.show', $job->id) }}">Read More</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Lamaran :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tanggal Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            @datetime($user->jobs->find($job->id)->pivot->created_at)
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Status</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <span class="badge badge-pill badge-warning">{!! $user->jobs->find($job->id)->pivot->status !!}</span> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col card mb-2 pull-left">
                                                                        <div class="card-body pt-0 pl-0">
                                                                            {{ $user->jobs->find($job->id)->pivot->description }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Note Accept --}}
                                            <div class="modal fade" id="modal-accept-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Catatan Penerimaan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('accept') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="application_id" value="{{ $user->pivot->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Catatan:</label>
                                                            <input type="text" class="form-control" id="note" name="note">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin lamaran ini akan diterima?')">Accept</button>
                                                    </div>
                                                </form>                                                    
                                                </div>
                                            </div>
                                            </div>

                                            {{-- Modal Note Reject --}}
                                            <div class="modal fade" id="modal-reject-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Catatan Penolakan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('reject') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="application_id" value="{{ $user->pivot->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Catatan:</label>
                                                            <input type="text" class="form-control" id="note" name="note">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin lamaran ini akan ditolak?')">Reject</button>
                                                    </div>
                                                </form> 
                                                </div>
                                            </div>
                                            </div>

                                            
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    --- Tidak ada lamaran pekerjaan yang belum diproses ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ACCEPT --}}
    <div class="tab-pane fade" id="accept" role="tabpanel" aria-labelledby="accept-tab">
        <div class="card bg-light border-top-0">
            <div class="card-body pb-1">
                    @forelse($job_accept as $key1 => $job)
                    <div class="mt-3">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a id="black" style="text-decoration:none;" href="#collapseCard2-{{$key1}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard2">
                                <h5 class="m-0 font-weight-bold">{{ $job->title }}</h5>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCard2-{{$key1}}">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle">Pelamar</th>
                                            <th style="text-align: center; vertical-align: middle">Keterangan</th>
                                            <th style="text-align: center; vertical-align: middle">Status</th>
                                            <th style="text-align: center; vertical-align: middle">Detail Lamaran</th>
                                        </tr>
                                        @foreach($job->users as $key2 => $user)
                                        @if ($user->pivot->status == "Accept")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    <a data-toggle="modal" data-target="#detail-user2-{{$key1}}{{$key2}}" id="detail-user2-{{$key1}}{{$key2}}">{{ $user->name }}</a>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 150) !!}
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-success">{!! $user->pivot->status !!}</span>
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">     
                                                    <small><button type="button" data-toggle="modal" data-target="#detail-lamaran2-{{$key1}}{{$key2}}" class="btn btn-outline-primary" style="font-size: smaller" id="detail-lamaran2-{{$key1}}{{$key2}}">Detail</button></small>
                                                </td>
                                            </tr>

                                            {{-- Modal Detail User --}}
                                            <div class="modal fade " id="detail-user2-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="detail-user2-{{$key1}}{{$key2}}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detail-user2-{{$key1}}{{$key2}}">Detail User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Detail Lamaran --}}
                                            <div class="modal fade" id="detail-lamaran2-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Detail Lamaran</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Pekerjaan :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Nama Pekerjaan</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->title }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tempat</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->place }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Deskripsi </h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <a href="{{ route('job.show', $job->id) }}">Read More</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Lamaran :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tanggal Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            @datetime($user->jobs->find($job->id)->pivot->created_at)
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Status</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <span class="badge badge-pill badge-success">{!! $user->jobs->find($job->id)->pivot->status !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col card mb-3 pull-left">
                                                                        <div class="card-body pt-0 pl-0">
                                                                            {{ $user->jobs->find($job->id)->pivot->description }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="card text-white bg-success">
                                                                        <div class="card-body">
                                                                            <p class="card-text">Note: "{{ $user->jobs->find($job->id)->pivot->note }}"</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    --- Tidak ada lamaran pekerjaan yang belum diproses ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>

    {{-- REJECT --}}
    <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">
        <div class="card bg-light border-top-0">
            <div class="card-body pb-1">
                @forelse($job_reject as $key1 => $job)
                    <div class="mt-3">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a id="black" style="text-decoration:none;" href="#collapseCard3-{{$key1}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard3">
                                <h5 class="m-0 font-weight-bold">{{ $job->title }}</h5>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCard3-{{$key1}}">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle">Pelamar</th>
                                            <th style="text-align: center; vertical-align: middle">Keterangan</th>
                                            <th style="text-align: center; vertical-align: middle">Status</th>
                                            <th style="text-align: center; vertical-align: middle">Detail Lamaran</th>
                                        </tr>
                                        @foreach($job->users as $key2 => $user)
                                        @if ($user->pivot->status == "Reject")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    <a data-toggle="modal" data-target="#detail-user3-{{$key1}}{{$key2}}" id="detail-user3-{{$key1}}{{$key2}}">{{ $user->name }}</a>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 150) !!}
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-danger">{!! $user->pivot->status !!}</span>
                                                </td>
                                                <td width="50px" style="text-align: center; vertical-align: middle">     
                                                    <small><button type="button" data-toggle="modal" data-target="#detail-lamaran3-{{$key1}}{{$key2}}" class="btn btn-outline-primary" style="font-size: smaller" id="detail-lamaran3-{{$key1}}{{$key2}}">Detail</button></small>
                                                </td>
                                            </tr>

                                            {{-- Modal Detail User --}}
                                            <div class="modal fade " id="detail-user3-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="detail-user3-{{$key1}}{{$key2}}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detail-user3-{{$key1}}{{$key2}}">Detail User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Detail Lamaran --}}
                                            <div class="modal fade" id="detail-lamaran3-{{$key1}}{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Detail Lamaran</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Pekerjaan :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Nama Pekerjaan</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->title }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tempat</h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            {{ $job->place }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Deskripsi </h6>
                                                                        </div>
                                                                        <div class="col-1 pull-left">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <a href="{{ route('job.show', $job->id) }}">Read More</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col-7">
                                                                    <div><h5><strong>Identitas Pelamar :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Nama </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Email </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->email }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-4">
                                                                            <h6>Tanggal Lahir </h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-7 pull-left">
                                                                            {{ $user->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 pull-left">
                                                                    <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                                                    <div class="row col">
                                                                        {{-- button download CV --}}
                                                                        <form action="{{ url('download-cv') }}" method="POST" >
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                            <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="700px">
                                                            <div class="row col">
                                                                <div class="col-md-7">
                                                                    <div><h5><strong>Keterampilan : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->skill as $u)
                                                                                <li>
                                                                                    <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div><h5><strong>Pengalaman : </strong></h5></div>
                                                                    <div>
                                                                        <ul>
                                                                            @foreach ($user->experience as $u)
                                                                                <li>
                                                                                    {{ $u->experience }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr style="height:3px; border:none; color:forestgreen; background-color:forestgreen;">

                                                            <div class="row col">
                                                                <div class="col">
                                                                    <div><h5><strong>Lamaran :</strong></h5></div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Tanggal Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            @datetime($user->jobs->find($job->id)->pivot->created_at)
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Status</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                        <div class="col-8 pull-left">
                                                                            <span class="badge badge-pill badge-danger">{!! $user->jobs->find($job->id)->pivot->status !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col">
                                                                        <div class="col-3">
                                                                            <h6>Lamaran</h6>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <h6>:</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col card mb-3 pull-left">
                                                                        <div class="card-body pt-0 pl-0">
                                                                            {{ $user->jobs->find($job->id)->pivot->description }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="card text-white bg-danger">
                                                                        <div class="card-body">
                                                                            <p class="card-text">Note: "{{ $user->jobs->find($job->id)->pivot->note }}"</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    --- Tidak ada lamaran pekerjaan yang belum diproses ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
