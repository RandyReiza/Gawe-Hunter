@extends('layouts.app')

@section('content')

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
                                            <th style="text-align: center; vertical-align: middle">Action</th>
                                        </tr>
                                        @foreach($job->users as $key2 => $user)
                                        @if ($user->pivot->status == "Unread")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    {{ $user->name }} <br>
                                                    <small><button type="button" data-toggle="modal" data-target="#detail-user-{{$key2}}" class="btn btn-outline-primary" style="font-size: smaller" id="detail-user-{{$key2}}">Detail</button></small>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 100) !!}
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-warning">{!! $user->pivot->status !!}</span>
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">
                                                    <small><button style="font-size: smaller" class="btn btn-success btn-sm" title="Accept" type="button" data-toggle="modal" data-target="#modal-accept-{{$key2}}"><i class="icon fa fa-check"></i></button></small>
                                                    <small><button style="font-size: smaller" class="btn btn-danger btn-sm" title="Reject" type="button" data-toggle="modal" data-target="#modal-reject-{{$key2}}"><i class="icon fa fa-times"></i></button></small>
                                                </td>
                                            </tr>

                                            {{-- Modal Detail User --}}
                                            <div class="modal fade " id="detail-user-{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="detail-user-{{$key2}}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detail-user-{{$key2}}">Detail User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div>
                                                                            <h6>Nama : {{ $user->name }}</h6>
                                                                        </div>
                                                                        <div>
                                                                            <h6>Email : {{ $user->email }}</h6>
                                                                        </div>
                                                                        <div>
                                                                            <h6>Tanggal Lahir : {{ $user->tgl_lahir }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div>
                                                                            {{-- output nama file CV --}}
                                                                            <h6>CV : {{ substr($user->cv->file, strpos($user->cv->file, "_") + 1) }}</h6>
                                                                        </div>
                                                                        <div>
                                                                            {{-- button download CV --}}
                                                                            <form action="{{ url('download-cv') }}" method="POST" >
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="file" value="{{ $user->cv->file }}">
                                                                                <button type="submit" class="btn btn-outline-success">Download CV</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div >
                                                                            <h6>Keterampilan : </h6>
                                                                            <ul>
                                                                                @foreach ($user->skill as $u)
                                                                                    <li>
                                                                                        <strong>{{ $u->skill }}</strong> : {{ $u->level }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div>
                                                                            <h6>Pengalaman : </h6>
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
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Note Accept --}}
                                            <div class="modal fade" id="modal-accept-{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <div class="modal fade" id="modal-reject-{{$key2}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                @forelse($job_accept as $key => $job)
                    <div class="mt-3">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a id="black" style="text-decoration:none;" href="#collapseCard-{{$key}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                <h5 class="m-0 font-weight-bold">{{ $job->title }}</h5>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCard-{{$key}}">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle">Pelamar</th>
                                            <th style="text-align: center; vertical-align: middle">Keterangan</th>
                                            <th style="text-align: center; vertical-align: middle">Status</th>
                                        </tr>
                                        @foreach($job->users as $user)
                                        @if ($user->pivot->status == "Accept")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    {{ $user->name }} <br>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 100) !!}
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-success">{!! $user->pivot->status !!}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    --- Tidak ada lamaran pekerjaan yang sudah diterima ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>

    {{-- REJECT --}}
    <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">
        <div class="card bg-light border-top-0">
            <div class="card-body pb-1">
                @forelse($job_reject as $key => $job)
                    <div class="mt-3">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a id="black" style="text-decoration:none;" href="#collapseCard-{{$key}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                <h5 class="m-0 font-weight-bold">{{ $job->title }}</h5>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCard-{{$key}}">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle">Pelamar</th>
                                            <th style="text-align: center; vertical-align: middle">Keterangan</th>
                                            <th style="text-align: center; vertical-align: middle">Status</th>
                                        </tr>
                                        @foreach($job->users as $user)
                                        @if ($user->pivot->status == "Reject")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    {{ $user->name }} <br>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 100) !!}
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-danger">{!! $user->pivot->status !!}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    --- Tidak ada lamaran pekerjaan yang sudah ditolak ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
