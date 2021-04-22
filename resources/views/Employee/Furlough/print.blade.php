<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Cuti NICT</title>
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
            <h3 class="title">Surat izin Cuti</h3>
            <p class="text-muted">Nomor: {{ $furlough->decree()->first()->sk_number }}</p>
            <p>Diberikan Cuti kepada Pegawai NICT:</p>
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
            <p>Selama {{ $furlough->long_furlough . ' ('. $furlough->in_number .') ' . $furlough->time_format }}, Terhitung Tanggal {{ Helper::time($furlough->start_date) }} sampai dengan tanggal {{ Helper::time($furlough->finish_date) }}, dengan ketentuan sebagai berikut :</p>
            <ol type="a">
                @foreach($furlough->provision()->get() as $ket)
                <li>{{ $ket->provision_name }}</li>
                @endforeach
            </ol>
            <p>Demikian Surat Cuti sakit ini dibuat untuk dapat digunakan sebagaimana mestinya</p>

            <table class="footer">
                <tbody>
                    <tr >
                        <td style="width: 60%;"></td>
                        <td style="width: 40%;">
                            <p style="margin: 30px 0;">Ciputat, {{ Helper::time(date('Y-m-d')) }}</p>
                            <p>Hormat Kami,<br>a/n. Admin pusat,<br>NICT</p>
                            <div style="padding: 2px 0;text-align: center;">{!! $sig !!}</div>
                            <p>{{ $admin->name }}<br>{{ $admin->work_unit()->first()->work_unit_name }}<br>NIP {{ $admin->nip }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
