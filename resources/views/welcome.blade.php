@extends('layouts.app')   {{-- layout blade template ngikut dulu ke master.blade.php {di folder layour dalam direktori VIEW} --}}

@section('title', 'Jobs')

@section('content')

{{-- alert -->> by Toastr.js & SweetAlert --}}
@if (Session::get('alert') == 'success')
    <script>
        window.onload = function() {
            toastr_alert("success", "{{ Session::get('message') }}", "Success")
            swal("Success", "{{ Session::get('message') }}", "success");
        }
    </script>
@elseif (Session::get('alert') == 'danger')
    <script>
        window.onload = function() {
            toastr_alert("error", "{{ Session::get('message') }}", "Deleted")
            swal("Terhapus", "{{ Session::get('message') }}", "error");
        }
    </script>
@else

@endif

<div class="row">
    <div class="row-3 mr-3">
        <h2>Daftar Pekerjaan</h2>
    </div>
        <div class="row-9">
            <a href="{{ route('create') }}" class="btn btn-raised btn-dark">Buat Pekerjaan</a>
        </div>
</div>
<hr>
<div id="list-job">
    @include('list-job')
</div>
@endsection

@section('foot')
<p>Footernya Job</p>
@endsection