@component('mail::message')
Permintaan Perubahan Jadwal Anda Telah Ditolak!

<p>Berikut adalah permintaan Jadwal yang ditolak:</p>

<p>
    @if($data['tipe_jadwal'] == 1)
        <p>Tanggal: {{ date('d-m-Y', strtotime($data['waktu_mulai'])); }}</p>
        <p>Kegiatan: {{ $data['kegiatan'] }}</p>
        <p>Ruangan: {{ $data['ruangan'] }}</p>
        <p>Pukul: {{ date('H:i', strtotime($data['waktu_mulai'])) }} - {{ date('H:i', strtotime($data['waktu_selesai'])) }}</p>
    @else
        <p>Tanggal: {{ date('d-m-Y', strtotime($data['waktu_mulai'])); }} s/d {{ date('d-m-Y', strtotime($data['waktu_selesai'])); }}</p>
        <p>Perjalanan Dinas</p>
    @endif
</p>

<p>Alasan: {{ $data['alasan'] }}</p>

<p>Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => '/'])
Klik Di Sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent
