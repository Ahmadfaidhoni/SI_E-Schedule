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
            border: 1px solid black;
            font-size: 15px;

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

        .table-striped tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <h2 style="text-align: center; font-size: 25px; margin-top: -2px; text-decoration: underline;">
            Daftar Penjawalan Pegawai
        </h2>
        <br>
        <br>
        <table style="border: none">
            <tr>
                <td style="width: 100px">Pegawai</td>
                <td>: {{ $user }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Jadwal</td>
                <td>: {{ $tipe_jadwal }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Tanggal</td>
                <td>: {{ $awal . ' - ' . $akhir }}</td>
            </tr>
        </table>
        <br>
        <br>
        <table border="3" class="table-striped">
            <thead>
                <th>#</th>
                <th>Kegiatan</th>
                <th>Pegawai</th>
                <th>Tanggal Kegiatan</th>
                <th>Jam</th>
                <th>Angkatan</th>
                <th>Ruangan</th>
                <th>JP</th>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $total = 0;
                    $total_jp = 0;
                    $total_mengajar = 0;
                    $total_perjalanan_dinas = 0;
                @endphp
                @foreach ($jadwal as $jdwl)
                    <tr class="text-center">
                        <td align="center">{{ ++$i }}.</td>
                        <td>
                            @if ($jdwl->tipe_jadwal == 2)
                                Perjalanan Dinas
                            @else
                                {{ isset($jdwl->kegiatan) ? $jdwl->kegiatan->nama_kegiatan : '-' }}
                            @endif
                        </td>
                        <td>{{ isset($jdwl->user) ? $jdwl->user->name : '-' }}</td>
                        @if ($jdwl->tipe_jadwal == 1)
                            <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }}</td>
                        @else
                            <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }} s/d
                                {{ date('d-m-Y', strtotime($jdwl->waktu_selesai)) }}</td>
                        @endif
                        <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                            {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                        <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                        <td>{{ isset($jdwl->ruangan) ? $jdwl->ruangan->nama_ruangan : '-' }}</td>
                        <td>
                            @if ($jdwl->jp < $max_jp) 
                                {{ $jdwl->jp }} 
                            @else 
                                Full Day 
                            @endif 
                        </td> 
                    </tr> 
                    @php 
                        if ($jdwl->jp < $max_jp) { $total_jp +=$jdwl->jp;}
                        
                        if ($jdwl->tipe_jadwal == 2) {
                                $total_perjalanan_dinas += 1;
                        } else {
                                $total_mengajar += 1;
                        }
                    @endphp
                @endforeach
                
                <tr>
                    <td colspan="7" style="padding-left: 1rem">Total JP Mengajar</td>
                    <td class="text-center">{{ $total_jp }}</td>
                </tr>
                <tr>
                    <td colspan="7" style="padding-left: 1rem">Total Kegiatan Mengajar</td>
                    <td class="text-center">{{ $total_mengajar }}</td>
                </tr>
                <tr>
                    <td colspan="7" style="padding-left: 1rem">Total Kegiatan Perjalan Dinas</td>
                    <td class="text-center">{{ $total_perjalanan_dinas }}</td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>
<script>
    window.print();
</script>
