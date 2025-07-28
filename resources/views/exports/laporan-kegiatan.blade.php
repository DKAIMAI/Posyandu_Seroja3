<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Balita</th>
            <th>Anak Ke</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Nomor KK</th>
            <th>NIK Balita</th>
            <th>BBL</th>
            <th>PBL</th>
            <th>Nama Ortu</th>
            <th>NIK Ortu</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
            <th>Tanggal Ukur</th>
            <th>Usia (bulan)</th>
            <th>BB</th>
            <th>TB</th>
            <th>LILA</th>
            <th>Status KMS</th>
            <th>NTT</th>
            <th>Vitamin A</th>
            <th>Obat Cacing</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kegiatan as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->balita->nama_balita }}</td>
            <td>{{ $item->balita->anak_ke }}</td>
            <td>{{ $item->balita->tgl_lahir }}</td>
            <td>{{ $item->balita->jenis_kelamin }}</td>
            <td>{{ $item->balita->nomor_kk }}</td>
            <td>{{ $item->balita->nik_balita }}</td>
            <td>{{ $item->balita->bbl }}</td>
            <td>{{ $item->balita->pbl }}</td>
            <td>{{ $item->balita->user->nama_ortu }}</td>
            <td>{{ $item->balita->user->nik_ortu }}</td>
            <td>{{ $item->balita->user->no_hp }}</td>
            <td>{{ $item->balita->user->alamat }}</td>
            <td>{{ $item->balita->user->rt }}</td>
            <td>{{ $item->balita->user->rw }}</td>
            <td>{{ $item->tgl_ukur }}</td>
            <td>{{ $item->usia_bulan }}</td>
            <td>{{ $item->bb_balita }}</td>
            <td>{{ $item->tb_balita }}</td>
            <td>{{ $item->lila_balita }}</td>
            <td>{{ $item->status_kms }}</td>
            <td>{{ $item->ntt_balita }}</td>
            <td>{{ $item->vitamin_a }}</td>
            <td>{{ $item->obat_cacing }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
