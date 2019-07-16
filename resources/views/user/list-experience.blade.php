@forelse ($exp as $key => $e)
    <tr>
        <td width="30px" style="text-align: center; vertical-align: middle"><li></li></td>
        <td style="text-align: center; vertical-align: middle">{{ $e->experience }}</td>
        <form method="POST" action="{{ route('experience.destroy', $e->id) }}">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <td width="10px"><small><button style="font-size: smaller" class="btn" title="Hapus" onclick="return confirm('Anda yakin pengalaman ini akan dihapus?')"><i class="icon fa fa-times" style="color:red"></i></button></small></td>
        </form>
    </tr>
@empty
    <tr>
        <td colspan="2">-- Belum memasukkan Pengalaman --</td>
    </tr>
@endforelse