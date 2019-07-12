@foreach ($jobs as $job)
<div class="mt-3">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold">{{ $job->title }}</h3>
            </div>
            <div class="card-body">
                <span style="color:blue">@datetime($job->created_at)</span>
                <br>
                {!! str_limit($job->description, 100) !!}
                <br>
                <a href="{{ route('show', $job->id) }}">Read More</a>
            </div>
          </div>
    <h2>
        
        <a href="{{ route('show', $job->id) }}" style="color: black;">
            {{ $job->title }}
        </a>
    </h2>
    
    <div>
        <div class="mb-1">
            {{-- formatter tanggal bikinan sendiri -> bisa d lihat di file "AppServiceProvider.php" --}}
            <span style="color:blue">@datetime($job->created_at)</span>
        </div>
        
        <div>
            {{-- limit isi konten --}}
            {!! str_limit($job->description, 100) !!}
            <br>
            {{-- read more utk k view show --}}
            <a href="{{ route('show', $job->id) }}">Read More</a>
            <br>
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