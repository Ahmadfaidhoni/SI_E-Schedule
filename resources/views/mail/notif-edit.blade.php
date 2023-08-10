@component('mail::message')
Jadwal telah diubah menjadi:

@if($validatedData['tipe_jadwal'] == 1)
    <p>Tanggal: {{ date('d-m-Y', strtotime($validatedData['waktu_mulai'])); }}</p>
    <p>Kegiatan: {{ $validatedData['kegiatan'] }}</p>
    <p>Ruangan: {{ $validatedData['ruangan'] }}</p>
    <p>Pukul: {{ date('H:i', strtotime($validatedData['waktu_mulai'])) }} - {{ date('H:i', strtotime($validatedData['waktu_selesai'])) }}</p>
@else
    <p>Tanggal: {{ date('d-m-Y', strtotime($validatedData['waktu_mulai'])); }} s/d {{ date('d-m-Y', strtotime($validatedData['waktu_selesai'])); }}</p>
    <p>Perjalanan Dinas</p>
@endif

<p>Keterangan: {{ $validatedData['keterangan'] }}</p>
<p>Biaya: {{ $validatedData['biaya'] }}</p>

Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.

@component('mail::button', ['url' => '/'])
Klik di sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent