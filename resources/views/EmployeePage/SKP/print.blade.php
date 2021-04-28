<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKP NICT</title>
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
            <h3 class="title">Sasaran kinerja Pegawai</h3>
            <p class="text-muted">ID: {{ $employeeWorkObjective->employee_work_objective_id }}</p>
            <p>Dilakukan penilaian terhadap peforma kinerja pegawai dengan data:</p>
            <table class="profil">
                <tbody>
                    <tr>
                        <td style="width: 45%">Nama</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">NIP</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employee->nip }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Pangkat/Golongan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employee->occupation_group()->first()->occupation_group_name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Jabatan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employee->employment()->first()->employment_name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Unit Kerja</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employee->work_unit()->first()->work_unit_name }}</td>
                    </tr>
                </tbody>
            </table>
            <p>Telah dinilai oleh:</p>
            <table class="profil">
                <tbody>
                    <tr>
                        <td style="width: 45%">Nama Pejabat Penilai</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->assessor_officials }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nama Atasan Pejabat Penilai</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->appraisal_official_superior }}</td>
                    </tr>
                </tbody>
            </table>
            <p>Selama periode penilaian, Terhitung Tanggal {{ Helper::time($employeeWorkObjective->start_date) }} sampai dengan tanggal {{ Helper::time($employeeWorkObjective->finish_date) }}, dilakukan penilaian terhadap kinerja dengan nilai :</p>

            <table class="profil">
                <tbody>
                    <tr>
                        <td style="width: 45%">Nilai Orientasi Pelayanan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->service_orientation_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nilai Integritas</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->integrity_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nilai Komitmen</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->commitment_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nilai Disiplin</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->discipline_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nilai Kerjasama</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->teamwork_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Nilai Kepemimpinan</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->leader_value }}</td>
                    </tr>
                    <tr>
                        <td style="width: 45%">Hasil Penilaian</td>
                        <td style="width: 5%">:</td>
                        <td style="width: 50%">{{ $employeeWorkObjective->rating_result }}</td>
                    </tr>
                </tbody>
            </table>
            <p>Demikian SKP ini dibuat untuk dapat digunakan sebagaimana mestinya</p>
        </div>
    </div>
</body>
</html>
