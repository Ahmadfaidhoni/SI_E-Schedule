@component('mail::message')
Permintaan Perubahan Jadwal Baru:

<p>
    @if($validatedData['tipe_jadwal'] == 1)
        <p>Tanggal: {{ date('d-m-Y', strtotime($validatedData['waktu_mulai'])); }}</p>
        <p>Kegiatan: {{ $validatedData['kegiatan'] }}</p>
        <p>Ruangan: {{ $validatedData['ruangan'] }}</p>
        <p>Pukul: {{ date('H:i', strtotime($validatedData['waktu_mulai'])) }} - {{ date('H:i', strtotime($validatedData['waktu_selesai'])) }}</p>
    @else
        <p>Tanggal: {{ date('d-m-Y', strtotime($validatedData['waktu_mulai'])); }} s/d {{ date('d-m-Y', strtotime($validatedData['waktu_selesai'])); }}</p>
        <p>Perjalanan Dinas</p>
    @endif
</p>

<p>Alasan: {{ $validatedData['alasan'] }}</p>
<p>Untuk melihat permintaan perubahan jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => '/'])
Klik Di Sini
@endcomponent

{{ config('app.name') }}
@endcomponent