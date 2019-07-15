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
        <div class="card border-top-0">
            <div class="card-body pb-1">
                @forelse($job_unread as $key => $job)
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
                                            <th style="text-align: center; vertical-align: middle">Action</th>
                                        </tr>
                                        @foreach($job->users as $user)
                                        @if ($user->pivot->status == "Unread")
                                            <tr>
                                                <td width="200px" style="text-align: center; vertical-align: middle">
                                                    {{ $user->name }} <br>
                                                </td>
                                                <td style="vertical-align: middle">              
                                                    {!! str_limit($user->pivot->description, 100) !!}
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">               
                                                    <span class="badge badge-pill badge-warning">{!! $user->pivot->status !!}</span>
                                                </td>
                                                <td width="100px" style="text-align: center; vertical-align: middle">
                                                    <small><a href="accept/{{ $user->pivot->id }}" style="font-size: smaller" class="btn btn-success btn-sm" title="Accept" onclick="return confirm('Anda yakin lamaran ini akan diterima?')"><i class="icon fa fa-check"></i></a></small>
                                                    <small><a href="reject/{{ $user->pivot->id }}" style="font-size: smaller" class="btn btn-danger btn-sm" title="Reject" onclick="return confirm('Anda yakin lamaran ini akan ditolak?')"><i class="icon fa fa-times"></i></a></small>
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
                    --- Tidak ada lamaran pekerjaan yang belum diproses ---
                    <hr>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ACCEPT --}}
    <div class="tab-pane fade" id="accept" role="tabpanel" aria-labelledby="accept-tab">
        <div class="card border-top-0">
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
        <div class="card border-top-0">
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
