@component('mail::message')
Selamat Datang {{ $validatedData['name'] }}

Status anda saat ini menjabat sebagai {{ $validatedData['jabatan'] }}

<p>Untuk melihat informasi lebih banyak lagi silahkan kunjungi Website E-Schedule,
dan login menggunakan email dan password anda. </p>

<p>Untuk mengetahui Password anda saat ini silahkan hubungi admin,
atau bisa dengan klik tombol di bawah.</p>

@component('mail::button', ['url' => '/'])
Klik di sini
@endcomponent

Hormat Kami,<br>
Admin {{ config('app.name') }}
@endcomponent
