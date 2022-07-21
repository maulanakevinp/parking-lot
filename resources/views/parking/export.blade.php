<table>
    <thead>
        <tr>
            <th>Kode Unik</th>
            <th>Plat Nomor</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
            <th>Biaya</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($parkings as $item)
            <tr>
                <td>{{ $item->unique_code }}</td>
                <td>{{ $item->license_plate }}</td>
                <td>{{ $item->start_time }}</td>
                <td>{{ $item->end_time }}</td>
                <td>
                    @if ($item->end_time != null)
                        {{ $item->price }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
