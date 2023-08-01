@component('mail::message')
Perubahan Jadwal Anda Diganti Pegawai Lain!

<p>Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => 'schedule.regbandung.com'])
Klik Di Sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent
