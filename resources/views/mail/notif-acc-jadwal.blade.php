@component('mail::message')
Jadwal Berhasil diubah menjadi:

<p>Tanggal: {{ date('d-m-Y', strtotime($data['waktu_mulai'])); }}</p>
<p>Pukul: {{ date('H:i', strtotime($data['waktu_mulai'])) }} - {{ date('H:i', strtotime($data['waktu_selesai'])) }}</p>

Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.

@component('mail::button', ['url' => 'schedule.regbandung.com'])
Klik di sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent
