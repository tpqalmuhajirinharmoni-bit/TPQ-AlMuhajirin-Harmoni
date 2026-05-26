@extends('layouts.app')

@section('title', 'Organisasi - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Struktur Organisasi</h2>
  <p>Data pengurus, pembina, dan struktur organisasi TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Struktur Organisasi</h3>
  <p>TPQ Al Muhajirin Harmoni dikelola oleh tim yang berkomitmen untuk meningkatkan kualitas pendidikan Al-Qur'an dan karakter santri.</p>
  <div class="stats-grid" style="margin-top:1.5rem; gap:1rem;">
    <article class="stats-card">
      <span class="stats-label">Total Staf TPQ</span>
      <strong>{{ number_format($stats['staff']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Guru</span>
      <strong>{{ number_format($stats['teachers']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri</span>
      <strong>{{ number_format($stats['students']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Wali Santri</span>
      <strong>{{ number_format($stats['guardians']) }}</strong>
    </article>
  </div>

  <table style="margin-top:1.5rem;">
    <thead>
      <tr>
        <th>Peran</th>
        <th>Jumlah Tersedia</th>
        <th>Contoh Pengguna</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roles as $role)
        <tr>
          <td>{{ $role->name }}</td>
          <td>{{ $role->users_count }}</td>
          <td>
            @if($role->users->isNotEmpty())
              {{ $role->users->pluck('name')->take(3)->join(', ') }}@if($role->users->count() > 3), ...@endif
            @else
              Belum diisi
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="overview-grid" style="margin-top: 2rem;">
  <div class="card-form">
    <h3>Visi Pengurus</h3>
    <p>Mengembangkan TPQ menjadi lembaga yang profesional, inklusif, dan berwawasan kebangsaan.</p>
  </div>
  <div class="card-form">
    <h3>Misi Pengurus</h3>
    <ul>
      <li>Menyediakan pembelajaran Al-Qur'an yang terstruktur.</li>
      <li>Meningkatkan kualitas guru dan pembimbing.</li>
      <li>Menjaga transparansi operasional dan keuangan.</li>
    </ul>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Tim Pendidikan</h3>
  <p>Tim pendidikan bertanggung jawab atas kurikulum, pengembangan guru, dan metode pengajaran yang sesuai kebutuhan santri.</p>
  <ul>
    <li>Koordinator Guru Putra & Putri</li>
    <li>Tim Kurikulum Al-Qur'an</li>
    <li>Tim Evaluasi dan Pembinaan Santri</li>
  </ul>
</div>
@endsection
