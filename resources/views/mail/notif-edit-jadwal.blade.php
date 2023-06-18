@component('mail::message')
Jadwal Sedang diproses.

<p>Mohon tunggu notifikasi selanjutnya.</p>

<p>Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => 'schedule.regbandung.com'])
Klik di sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent