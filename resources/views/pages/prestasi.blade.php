@extends('layouts.app')

@section('title', 'Prestasi Santri - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Prestasi Santri</h2>
  <p>Informasi prestasi santri dan rekomendasi penghargaan berbasis catatan kehadiran.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Prestasi Diverifikasi</span>
      <strong>{{ number_format($achievementSummary['verified']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Pengajuan Baru</span>
      <strong>{{ number_format($achievementSummary['pending']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Santri</span>
      <strong>{{ number_format($santriTotal) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Rekomendasi Teratas</span>
      <strong>{{ number_format($topStudents->count()) }}</strong>
    </article>
  </div>
</div>

<section class="dashboard-card admin-panel">
  <h3>Santri dengan Kehadiran Terbaik</h3>
  <p class="text-muted">Rekap ini membantu menentukan santri berprestasi dari aspek ketepatan dan kehadiran.</p>

  @if($topStudents->isEmpty())
    <div class="empty-state">Belum ada data santri untuk rekomendasi prestasi.</div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nama Santri</th>
            <th>Hadir</th>
            <th>Absen</th>
            <th>Telat</th>
          </tr>
        </thead>
        <tbody>
          @foreach($topStudents as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>{{ $student->present_count }}</td>
              <td>{{ $student->absent_count }}</td>
              <td>{{ $student->late_count }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif

  <div class="section-footer">
    <a href="{{ route('admin') }}" class="button">Kembali ke Dashboard Admin</a>
  </div>
</section>
@endsection
