@forelse ($skill as $key => $s)
    <tr>
        <td width="30px">{{ ++$key }}</td>
        <td><span class="badge badge-pill badge-success">{{ $s->skill }}</span></td>
        <td><span class="badge badge-pill badge-primary">{{ $s->level }}</span></td>
    </tr>
@empty
    <tr>
        <td colspan="3">-- Belum memasukkan Kemampuan --</td>
    </tr>
@endforelse