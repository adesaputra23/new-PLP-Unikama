<table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th colspan="16" style="text-align: center;">EXPORT DATA MAHASISWA PLP I DAN PLP II</th>
        </tr>
        <tr>
            <th><b>No</b></th>
            <th><b>NPM</b></th>
            <th><b>NAMA MAHASISWA</b></th>
            <th><b>JENIS PLP</b></th>
            <th><b>PROGRAM STUDI</b></th>
            <th><b>FAKULTAS</b></th>
            <th><b>KELAS</b></th>
            <th><b>ANGKATAN</b></th>
            <th><b>IPK</b></th>
            <th><b>JENIS KELAMIN</b></th>
            <th><b>ALAMAT</b></th>
            <th><b>NO HP</b></th>
            <th><b>AGAMA</b></th>
            <th><b>TANGGAL PENDAFTRAN</b></th>
            <th><b>TANGGAL PEMBAYARAN</b></th>
            <th><b>TANGGAL VERIFIKASI</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mhs as $item => $data_mhs)
            <tr>
                <td>{{ $item + 1 }}</td>
                <td>{{ $data_mhs->npm }}</td>
                <td>{{ $data_mhs->nama_mhs }}</td>
                <td>{{ $list_plp[$data_mhs->jenis_plp] }}</td>
                <td>{{ $list_prodi[$data_mhs->program_studi] }}</td>
                <td>{{ $list_fakultas[$data_mhs->fakultas] }}</td>
                <td>{{ $list_kelas[$data_mhs->kelas] }}</td>
                <td>{{ $data_mhs->angkatan }}</td>
                <td>{{ $data_mhs->ipk }}</td>
                <td>{{ $list_jenis_kelamin[$data_mhs->jenis_kelamin] }}</td>
                <td>{{ $data_mhs->alamat }}</td>
                <td>{{ $data_mhs->no_hp }}</td>
                <td>{{ $data_mhs->agama }}</td>
                <td>{{ $data_mhs->tgl_pendaftaran }}</td>
                <td>{{ $data_mhs->tgl_pembayaran }}</td>
                <td>{{ $data_mhs->tgl_verifikasi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
