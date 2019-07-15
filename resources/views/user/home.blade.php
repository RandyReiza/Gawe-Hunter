@extends('layouts.app')

@section('content')

<div class="row-3 mr-3">
    <h2>Daftar Lamaran Pekerjaan</h2>
</div>
<hr>


<div class="card">
    <div class="card-body pb-1">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th style="text-align: center; vertical-align: middle">Pekerjaan</th>
                <th style="text-align: center; vertical-align: middle">Tempat</th>
                <th style="text-align: center; vertical-align: middle">Deskripsi Pekerjaan</th>
                <th style="text-align: center; vertical-align: middle">Status</th>
                <th style="text-align: center; vertical-align: middle">Detail Lamaran</th>
            </tr>
            @forelse (Auth::user()->jobs as $key => $job)
                <tr>
                    <td width="200px" style="text-align: center; vertical-align: middle">
                        {{ $job->title }} <br>
                        (@datetime($job->pivot->created_at) ) <br>
                        <small><a href="{{ route('job.show', $job->id) }}" class="btn btn-outline-primary" style="font-size: smaller">Detail</a></small>
                    </td>
                    <td width="50px" style="text-align: center; vertical-align: middle">
                        {{ $job->place }}
                    </td>
                    <td style="vertical-align: middle">              
                        {!! str_limit($job->description, 100) !!}
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
                            <h5 class="modal-title" id="exampleModalLabel">Detail Lamaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="ml-5 mr-5">
                                    <div>
                                        <h5>Pekerjaan : {{ $job->title }}</h5>
                                    </div>
                                    <div>
                                        Tempat : {{ $job->place }}
                                    </div>
                                    <div class="mb-1">
                                        Deskripsi : {!! str_limit($job->description, 100) !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('job.show', $job->id) }}">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="ml-5 mr-5">
                                    <div>
                                        Tanggal Melamar : @datetime($job->pivot->created_at)
                                    </div>
                                    <div>
                                        Lamaran : {{ $job->pivot->description }}
                                    </div>
                                    <div>
                                        Status : 
                                        @if ($job->pivot->status == "Unread")
                                            <span class="badge badge-pill badge-warning">{!! $job->pivot->status !!}</span>   
                                        @elseif ($job->pivot->status == "Accept")
                                            <span class="badge badge-pill badge-success">{!! $job->pivot->status !!}</span>
                                        @elseif ($job->pivot->status == "Reject")
                                            <span class="badge badge-pill badge-danger">{!! $job->pivot->status !!}</span>                                                
                                        @endif
                                    </div>
                                    <div>
                                        @if ($job->pivot->note !== "")
                                            Catatan : {{ $job->pivot->note }}                                              
                                        @endif
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
            @empty
                --- Anda belum melamar pekerjaan ---
            @endforelse
        </table>
    </div>
</div>
@endsection
