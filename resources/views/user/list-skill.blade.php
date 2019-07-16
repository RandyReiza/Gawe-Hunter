@forelse ($skill as $key => $s)
    <tr>
        <td width="30px"><li></li></td>
        <td><span class="badge badge-pill badge-success" style="text-align: center; vertical-align: middle">{{ $s->skill }}</span></td>
        <td><span class="badge badge-pill badge-primary" style="text-align: center; vertical-align: middle">{{ $s->level }}</span></td>
        <form method="POST" action="{{ route('skill.destroy', $s->id) }}">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <td width="10px"><small><button style="font-size: smaller" class="btn" title="Hapus" onclick="return confirm('Anda yakin keterampilan ini akan dihapus?')"><i class="icon fa fa-times" style="color:red"></i></button></small></td>
        </form>
    </tr>
@empty
    <tr>
        <td colspan="3">-- Belum memasukkan Kemampuan --</td>
    </tr>
@endforelse