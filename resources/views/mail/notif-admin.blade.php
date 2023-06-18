@component('mail::message')
Permintaan Perubahan Jadwal Baru:

<p>Untuk melihat permintaan perubahan jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => 'schedule.regbandung.com'])
Klik Di Sini
@endcomponent

{{ config('app.name') }}
@endcomponent