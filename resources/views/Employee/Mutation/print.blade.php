<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <style>
        p {
            font-size: 12px;
        }
        .container {
            margin: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <table border="0"  style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 70%;">
                        <table border="0"  style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;"><img src="{{ $logo }}" width="50" alt="logo"></td>
                                    <td style="width: 80%;">
                                        <p>Kementrian Agama Republik Indonesia<br>National Information and Communication Technologi<br>Jl. Juanda No. 32 Ciputat Tangerang Selatan<br>Telp. (021) 12345, Fax (021) 1234</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width: 30%;">
                        <p>Surat Ini adalah dokumen resmi<br>yang dihasilkan oleh<br>NICT UIN Syarif Hidayatullah Jakarta<br>http://nict.uinjkt.ac.id</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="1"  style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 80%;">
                        <h5>SURAT TANDA BUKTI MUTASI NICT UIN SYARIF HIDAYATULLAH</h5>
                        <p>PUSAT LAYANAN ADMINISTRASI</p>
                        <p>NICT . KEMENAG RI</p>
                    </td>
                    <td>
                        <h1 style="padding: 10px;text-align:center;">{{ $mutation->decree()->first()->sk_number }}</h1>
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 70%;">
                        <p>Kepada yth,<br><b>{{ $employee->name }}<b><br>di {{ $employee->work_unit()->first()->work_unit_name }}<br>Kota Ciputat - Tangerang</b></p>
                    </td>
                    <td style="width: 30%;">
                        <p>Tanggal : {{ Helper::time(date('Y-m-d')) }}</p>
                        <p>Perihal :Surat Tanda Bukti Mutasi {{ $type_mutation }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                <p>Dengan Hormat,<br>Dengan diterbitkannya surat ini, NICT UIN Syarif Hidayatullah Jakarta . KEMENAG RI menyatakan bahwa anda <b>TELAH RESMI</b> {{ $type_mutation }}. </p>
            </div>
        </div>

        <table border="1" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="padding: 5px;width: 30%;"><p>Unit Kerja</p></td>
                    <td style="padding: 5px;width: 70%;"><p>{{ $mutation->new_work_unit }}</p></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><p>Alamat</p></td>
                    <td style="padding: 5px;"><p>{{ $mutation->address }}</p></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><p>Naungan</p></td>
                    <td style="padding: 5px;"><p>{{ $mutation->region_work }}</p></td>
                </tr>
            </tbody>
        </table>

        <p>Proses mutasi ini mulai efektif pada tanggal {{ Helper::time($mutation->decree()->first()->sk_date_start) }}. Oleh karena itu, kepada pegawai yang bersangkutan untuk segera mempersiapkan.</p>
        <p>Untuk informasi dan panduan selengkapnya dapat diakses di http://nict.uinjkt.ac.id </p>
        <p>Jika terjadi kendala, Anda dapat menghubungi Admin setempat atau email ke support@nict.uinjkt.ac.id</p>
        <p>Demikian surat mutasi ini dibuat untuk dapat dipergunakan sebagaimana mestinya. </p>
        <table border="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 60%;"></td>
                    <td style="width: 40%;">
                        <p>Kota Ciputat, {{ Helper::time($mutation->decree()->first()->sk_date_start) }}</p>
                        <p>Hormat Kami,<br>a/n. Admin pusat,<br>NICT</p>
                        <div style="padding: 2px 0;text-align: center;">{!! $sig !!}</div>
                        <p>TTD.<br>{{ $admin->name }}<br>Admin SIMPEG</p><p>UIN Syarif Hidayatullah<br>Kota Ciputat Prov. Banten</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
