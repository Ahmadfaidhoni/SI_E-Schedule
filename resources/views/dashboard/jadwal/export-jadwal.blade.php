<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Jadwal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="dist/themes/oldstyle.css" media="print">

    <style>
        @page {
            size: A4;
            margin: 5mm 0 5mm 0;
        }

        .sheet {
            overflow: visible;
            height: auto !important;
        }

        body {
            font-family: Nunito
        }

        h1 {
            font-family: Roboto;
            font-size: 14pt;
            line-height: 25px;
        }

        h2 {
            font-family: Roboto;
            font-size: 12pt;
        }

        h3 {
            font-family: Nunito;
            font-size: 12pt;
            line-height: 5mm;

        }

        .sub_total {
            margin-block-start: 0 !important;
            margin-block-end: 0 !important;
            line-height: 5mm !important;
        }

        h4 {
            font-family: Nunito;
            font-size: 9pt;
            font-weight: bold;
            margin-block-start: 0;
            margin-block-end: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            background-color: transparent;
            border: none;
        }

        .table th {
            padding: 8px 8px;
            font-weight: bold;
        }

        .table td {
            padding: 5px 5px 0px 0px;
            font-size: 12px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .underline {
            text-decoration: underline;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .mt-2 {
            margin-top: 2rem;
        }

        .mt-3 {
            margin-top: 3rem;
        }

        .mt-4 {
            margin-top: 5rem;
        }

        .ml-1 {
            margin-left: 0.5rem;
        }

        .ml-2 {
            margin-left: 1rem;
        }

        .ml-3 {
            margin-left: 1.5rem;
        }

        .pr-0 {
            padding-right: 0px;
        }

        .col-1 {
            flex: 0 0 8.33333%;
            max-width: 8.33333%;
        }

        .col-2 {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        .col-5 {
            flex: 0 0 41.66667%;
            max-width: 41.66667%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-7 {
            flex: 0 0 58.33333%;
            max-width: 58.33333%;
        }

        .col-8 {
            flex: 0 0 66.66667%;
            max-width: 66.66667%;
        }

        .col-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-10 {
            flex: 0 0 83.33333%;
            max-width: 83.33333%;
        }

        .col-11 {
            flex: 0 0 91.66667%;
            max-width: 91.66667%;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <div class="col-12">
            <div class="row">
                <div class="col-3 text-right">
                    <img src="{{ asset('ykep.png') }}" alt="" width="60"><br>
                </div>
                <div class="col-6 text-center">
                    {{-- <h2 style="font-size: 15px">FAKULTAS {{ $fac->facultyname }} UNIVERSITAS JENDRAL
                        ACHMAD YANI <br>
                        PROGRAM STUDI {{ $data->study_program->studyprogramname }}
                        <hr style="border: 1px solid">
                    </h2> --}}
                </div>
                <div class="col-3">
                    {{-- <img src="{{ asset('LOGO-UNJANI.png') }}" alt="" width="80"><br> --}}
                </div>
            </div>
        </div>
        <h2 style="text-align: center; font-size: 20px; margin-top: -2px;">
            Jadwal {{ $awal }}
            {{ $akhir }}
        </h2>
        <table border="3">
            <thead>
                <th>#</th>
                <th>Kegiatan</th>
                <th>Pegawai</th>
                <th>Jumlah JP</th>
                <th>Tanggal Kegiatan</th>
                <th>Jam</th>
                <th>Angkatan</th>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $total = 0;
                @endphp
                @foreach ($jadwal as $jdwl)
                    <tr>
                        <td align="center">{{ ++$i }}.</td>
                        <td>
                            @if ($jdwl->tipe_jadwal == 2)
                                Perjalanan Dinas
                            @else
                                {{ isset($jdwl->kegiatan) ? $jdwl->kegiatan->nama_kegiatan : '-' }}
                            @endif
                        </td>
                        <td>{{ isset($jdwl->user) ? $jdwl->user->name : '-' }}</td>
                        <td>
                            @if ($jdwl->jp < 15)
                                {{ $jdwl->jp }}
                            @else
                                Full Day
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }}</td>
                        <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                            {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                        <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                    </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
        <div class="col-12 mt-2">
            {{-- <div class="row">
                <div class="col-4 text-center" style="height: 25px"></div>
                <div class="col-4 text-center" style="height: 25px"></div>
                <div class="col-4 text-center" style="height: 25px">Cimahi, <p></p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 text-center">Mengetahui <br> Keuangan</div>
                <div class="col-4 text-center">Menyetujui <br> Dosen Wali</div>
                <div class="col-4 text-center">Mengajukan <br> Mahasiswa</div>

            </div>
            <div class="row">
                <div class="col-4 text-center" style="height: 90px"></div>
                <div class="col-4 text-center" style="height: 90px"></div>
                <div class="col-4 text-center" style="height: 90px"></div>
            </div>
            <div class="row">
                <div class="col-4 text-center">(..................)</div>
                <div class="col-4 text-center">(..................)</div>
                <div class="col-4 text-center">(..................)</div>
            </div> --}}
        </div>
    </section>
</body>

</html>
