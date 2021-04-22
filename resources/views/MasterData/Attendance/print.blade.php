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
            <p class="text-muted">Bulan: {{ Helper::convertMonthAttendance($date) }}</p>

            <table border="1" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="padding: 2px; text-align: center; width: 15%;" rowspan="2">Nama</th>
                        <th style="padding: 2px; text-align: center; width: 85%;" colspan="{{ $lastDay }}">Tanggal</th>
                    </tr>
                    <tr>
                        @for($day = 1; $day <= $lastDay; $day++)
                        <td style="padding: 2px; text-align: center;">{{ $day }}</td>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td class="name">{{ $employee->name }}</td>
                        @for($day = 1; $day <= $lastDay; $day++)
                            <td class="data" style="{{ (date('D', strtotime(date('Y-m') . '-' . $day)) == 'Sun' || date('D', strtotime(date('Y-m') . '-' . $day)) == 'Sat' ? 'background-color: red; ' : '') }}font-weight: bold;">
                            @foreach($data as $row)
                                @if($row->nip == $employee->nip)
                                    @if($row->date_work == $day)
                                    {{ (isset($row) ? $status[$row->kehadiran_id] : 'A') }}
                                    @endif
                                @endif
                            @endforeach
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="info"><b>Keterangan</b>: @for($i=0; $i < count($status); $i++) {!! '<span style="margin: 0 10px;"><b>' .$status[$i] . '</b>: ' . $ketStatus[$i] . ';</span>' !!} @endfor</p>
        </div>
    </div>
</body>
</html>
