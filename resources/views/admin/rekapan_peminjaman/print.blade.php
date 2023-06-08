<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <th>No</th>
                <th>Nama Sarana & Prasarana</th>
                <th>Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Durasi Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <TH>Status</TH>
            </thead>
            <tbody>
                @foreach ($rekapans as $no => $rekapan)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $rekapan->buku->nama_buku }}</td>
                        <td>{{ $rekapan->user->username }}</td>
                        <td>{{ $rekapan->tanggal_mulai_peminjaman }}</td>
                        <td>{{ $rekapan->durasi_peminjaman }} Hari</td>
                        <td>{{ $rekapan->tanggal_pengembalian }}</td>
                        <td><span class="badge badge-sm badge-success">Selesai</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
