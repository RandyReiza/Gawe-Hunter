@extends('layouts.app')

@section('title', 'GAWE HUNTER - Dashboard User')

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
    <h2>Daftar Lamaran Pekerjaan</h2>
</div>
<hr>

<div class="card bg-light">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th style="text-align: center; vertical-align: middle">Pekerjaan</th>
                <th style="text-align: center; vertical-align: middle">Tempat</th>
                <th style="text-align: center; vertical-align: middle">Lamaran</th>
                <th style="text-align: center; vertical-align: middle">Status</th>
                <th style="text-align: center; vertical-align: middle">Detail Lamaran</th>
            </tr>
            @forelse (Auth::user()->jobs->sortBy('created_at') as $key => $job)
                <tr>
                    <td width="200px" style="text-align: center; vertical-align: middle">
                        <a href="{{ route('job.show', $job->id) }}" id="black">{{ $job->title }}</a> <br>
                        <small><span style="font-size: smaller">(@datetime($job->pivot->created_at) )</span></small>
                    </td>
                    <td width="50px" style="text-align: center; vertical-align: middle">
                        {{ $job->place }}
                    </td>
                    <td style="vertical-align: middle">              
                        {!! str_limit($job->pivot->description, 150) !!}
                    </td>
                    <td width="50px" style="text-align: center; vertical-align: middle">               
                        @if ($job->pivot->status == "Unread")
                            <span class="badge badge-pill badge-warning">{!! $job->pivot->status !!}</span>   
                        @elseif ($job->pivot->status == "Accept")
                            <span class="badge badge-pill badge-success">{!! $job->pivot->status !!}</span>
                        @elseif ($job->pivot->status == "Reject")
                            <span class="badge badge-pill badge-danger">{!! $job->pivot->status !!}</span>                                                
                        @endif
                    </td>
                    <td width="50px" style="text-align: center; vertical-align: middle">              
                        <small><button class="btn btn-outline-dark" style="font-size: smaller" type="button" data-toggle="modal" data-target="#detail-lamaran-{{$key}}">Detail</button></small>
                    </td>
                </tr>


                {{-- Modal Detail Lamaran --}}
                <div class="modal fade" id="detail-lamaran-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                {{ Auth::user()->name }}
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
                                                {{ Auth::user()->email }}
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
                                                {{ Auth::user()->tgl_lahir }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 pull-left">
                                        <div><h5><strong>Curriculum Vitae :</strong></h5></div>
                                        <div class="row col">
                                            {{-- button download CV --}}
                                            <form action="{{ url('download-cv') }}" method="POST" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="file" value="{{ Auth::user()->cv->file }}">
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
                                                @foreach (Auth::user()->skill as $u)
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
                                                @foreach (Auth::user()->experience as $u)
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
                                                @datetime(Auth::user()->jobs->find($job->id)->pivot->created_at)
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
                                                @if (Auth::user()->jobs->find($job->id)->pivot->status == "Unread")
                                                    <span class="badge badge-pill badge-warning">{!! $job->pivot->status !!}</span>   
                                                @elseif (Auth::user()->jobs->find($job->id)->pivot->status == "Accept")
                                                    <span class="badge badge-pill badge-success">{!! $job->pivot->status !!}</span>
                                                @elseif (Auth::user()->jobs->find($job->id)->pivot->status == "Reject")
                                                    <span class="badge badge-pill badge-danger">{!! $job->pivot->status !!}</span>                                                
                                                @endif
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
                                                {{ Auth::user()->jobs->find($job->id)->pivot->description }}
                                            </div>
                                        </div>
                                        @if (Auth::user()->jobs->find($job->id)->pivot->status == "Accept")
                                            <div class="card text-white bg-success">
                                                <div class="card-body">
                                                    <p class="card-text">Note: "{{ Auth::user()->jobs->find($job->id)->pivot->note }}"</p>
                                                </div>
                                            </div>
                                        @elseif (Auth::user()->jobs->find($job->id)->pivot->status == "Reject")
                                            <div class="card text-white bg-danger">
                                                <div class="card-body">
                                                    <p class="card-text">Note: "{{ Auth::user()->jobs->find($job->id)->pivot->note }}"</p>
                                                </div>
                                            </div>                                               
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>                                                    
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; vertical-align: middle">
                        --- Anda belum melamar pekerjaan ---
                    </td>
                </tr>
                
            @endforelse
        </table>
    </div>
</div>
@endsection
