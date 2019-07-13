@foreach ($jobs as $job)
<div class="mt-3">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold">{{ $job->title }}</h4>
        </div>
        <div class="card-body pt-2">
            <div class="mb-1">
                <span style="color:blue">@datetime($job->created_at)</span>
            </div>
            <div class="mb-1">
                {!! str_limit($job->description, 100) !!}
            </div>
            <div>
                <a href="{{ route('job.show', $job->id) }}">Read More</a>
            </div>
        </div>
    </div>
</div>
<hr>
@endforeach

{{-- buat jarak ke footer (biar gk ketutupan footer) --}}
<div class="mb-5 d-flex justify-content-center">
    {{-- !!! pagination !!! --}}
    {{ $jobs->links('vendor.pagination.bootstrap-4') }}
</div>