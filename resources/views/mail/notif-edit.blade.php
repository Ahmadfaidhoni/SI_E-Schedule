@component('mail::message')
Jadwal telah diubah menjadi:

<p>Tanggal: {{ date('d-m-Y', strtotime($validatedData['waktu_mulai'])); }}</p>
<p>Pukul: {{ date('H:i', strtotime($validatedData['waktu_mulai'])) }} - {{ date('H:i', strtotime($validatedData['waktu_selesai'])) }}</p>
<p>Keterangan: {{ $validatedData['keterangan'] }}</p>

Untuk melihat jadwal lebih lanjut kunjungi Website
E-Schedule, atau bisa langsung dengan klik tombol di bawah.

@component('mail::button', ['url' => 'schedule.regbandung.com'])
Klik di sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent