@extends('layouts.app')

@section('title', 'Beranda - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero hero-home">
  <div class="hero-copy">
    <span class="eyebrow">Selamat Datang di TPQ Al Muhajirin Harmoni</span>
    <h2>Membentuk Generasi Qur'ani yang Berakhlak Mulia dan Harmoni Islami</h2>
    <p>Platform resmi TPQ untuk pendaftaran santri, manajemen kegiatan, informasi guru, dan dokumentasi kegiatan pendidikan Al-Qur'an.</p>
    <div class="hero-actions">
      <a href="{{ route('register') }}" class="button">Daftar Akun</a>
      <a href="{{ route('tpq.profile') }}" class="button">Profil TPQ</a>
      <a href="{{ route('blog') }}" class="button secondary">Baca Artikel</a>
    </div>
  </div>
  <div class="hero-panels">
    <article class="hero-card">
      <h3>Slogan Utama</h3>
      <p>“Membentuk generasi Qur'ani yang berakhlak mulia.”</p>
    </article>
    <article class="hero-card accent-card">
      <h3>Fokus Kami</h3>
      <ul>
        <li>Pengajaran Al-Qur'an yang profesional</li>
        <li>Penguatan akhlak dan keimanan</li>
        <li>Pelayanan santri dan wali yang transparan</li>
      </ul>
    </article>
  </div>
</section>

<section class="stats-section">
  <div class="stats-header">
    <h3>Statistik TPQ</h3>
    <p>Melihat data penting TPQ secara ringkas untuk memantau aktivitas dan layanan kami.</p>
  </div>
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Santri Terdaftar</span>
      <strong>{{ number_format($santriCount) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Guru Pengajar</span>
      <strong>{{ number_format($guruCount) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Kelas Aktif</span>
      <strong>{{ number_format($classroomCount) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Dokumentasi</span>
      <strong>{{ number_format($documentationCount) }}</strong>
    </article>
  </div>
</section>

<section class="feature-panel enhanced-panel">
  <div>
    <h3>Visi Kami</h3>
    <p>Menjadi pusat pembelajaran Al-Qur'an yang penuh manfaat, mendidik santri secara spiritual dan akademik.</p>
  </div>
  <div>
    <h3>Misi Kami</h3>
    <ul>
      <li>Mencetak generasi Qur'ani dengan akhlak mulia.</li>
      <li>Mendukung wali santri dengan informasi digital yang mudah diakses.</li>
      <li>Menyajikan sistem manajemen TPQ yang transparan dan modern.</li>
    </ul>
  </div>
</section>
@endsection
