<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kerja Harian Pegawai NICT</title>
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
            margin: 0 50px;
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
            <h3 class="title">Laporan Kerja Harian</h3>
            <p class="text-muted">Pegawai NICT</p>
            <table class="profil">
                <tbody>
                    <tr>
                        <td style="width: 30%">Nama</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%">NIP</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $employee->nip }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%">Pangkat/Golongan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $employee->occupation_group()->first()->occupation_group_name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%">Jabatan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $employee->employment()->first()->employment_name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%">Unit Kerja</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 65%">{{ $employee->work_unit()->first()->work_unit_name }}</td>
                    </tr>
                </tbody>
            </table>

            <table border="1" class="profil">
                <thead>
                    <tr>
                        <th style="padding: 2px;width: 5%;">No</th>
                        <th style="padding: 2px;width: 45%;">Tanggal</th>
                        <th style="padding: 2px;width: 30%;">Kegiatan Tugas</th>
                        <th style="padding: 2px;width: 10%;">Hasil</th>
                        <th style="padding: 2px;width: 10%;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyWorkReport->activity()->get() as $dwr)
                    <tr>
                        <td style="padding: 2px;width: 5%;">{{ $loop->iteration }}</td>
                        <td style="padding: 2px;width: 25%;">{{ Helper::time($dailyWorkReport->date_work) }}</td>
                        <td style="padding: 2px;width: 35%;">{{$dwr->activity }}</td>
                        <td style="padding: 2px;width: 25%;">{{$dwr->result }}</td>
                        <td style="padding: 2px;width: 10%;">{{$dwr->volume }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-top: 1.6rem;">Demikian Laporan Kerja Harian ini dibuat untuk dapat digunakan sebagaimana mestinya</p>
        </div>
    </div>
</body>
</html>
