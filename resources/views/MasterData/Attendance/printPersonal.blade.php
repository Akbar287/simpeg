<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}" type="image/x-icon">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
        }
        .container {
            margin: 10px;
        }
        .header {
          text-align: center;
          line-height: 25px;
          text-transform: uppercase;
        }
        .header span {
            font-size: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .body {
        }
        .body .title {
            text-transform: uppercase;
            text-decoration: underline;
            text-align:center;
        }
        .body .text-muted {
            text-transform: uppercase;
            text-align:center;
            font-weight: bold;
        }
        .profil {
            margin: 10px 30px;
            font-size: 15px;
            text-transform: capitalize;
        }
        .footer p {
            font-weight: bold;
            text-align:center;
        }
        td.name {
            font-size: 12px;
            font-weight:normal;
        }
        p.info {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table border="0"  style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 20%;"><img src="{{ $logo }}" width="50" alt="logo"></td>
                        <td style="width: 80%;text-align:center;">
                            <p>Kementrian Agama Republik Indonesia<br><span><b>National Information and Communication Technologi</b></span><br>Jl. Juanda No. 32 Ciputat Tangerang Selatan<br>Telp. (021) 12345, Fax (021) 1234</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="body">
            <h3 class="title">Laporan Absensi</h3>
            <p class="text-muted">Periode: {{ Helper::convertMonthAttendance($periode . '-01') }}</p>

            <table class="table" style="width: 100%;margin: 1rem;">
                <tr style="width: 100%">
                    <td style="width: 20%">NIP</td>
                    <td style="width: 25%">: {{ $user->nip }}</td>
                    <td style="width: 10%"></td>
                    <td style="width: 20%">Golongan</td>
                    <td style="width: 25%">: {{ $user->employment()->first()->employment_name }}</td>
                </tr>
                <tr style="width: 100%">
                    <td style="width: 20%">Nama</td>
                    <td style="width: 25%">: {{ $user->name }}</td>
                    <td style="width: 10%"></td>
                    <td style="width: 20%">Jabatan</td>
                    <td style="width: 25%">: {{ $occupation }}</td>
                </tr>
            </table>
            <table border="1" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Kerja</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($attendance))
                    <p style="text-align: center;font-size: 20px; font-style: italic; font-weight: bold;">Tidak Ada Data</p>
                    @else
                    @foreach($attendance as $att)
                    <tr>
                        <td class="name" style="padding: 5px;">{{ $att->date_work }}</td>
                        <td class="name" style="padding: 5px;">{{ $att->jenis_kerja }}</td>
                        <td class="name" style="padding: 5px;">{{ $att->start_work }}</td>
                        <td class="name" style="padding: 5px;">{{ $att->finish_work }}</td>
                        <td class="name" style="padding: 5px;">{{ $att->keterangan }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <p class="info"><b>Keterangan</b>: -</p>
        </div>
    </div>
</body>
</html>
