@extends('layouts.app')

@section('title', 'Raport Santri - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Raport Santri</h2>
  <p>Ringkasan kehadiran santri untuk mendukung pembuatan raport dan laporan akademik.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Santri Terdaftar</span>
      <strong>{{ number_format($reportSummary['santri']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Absensi Hari Ini</span>
      <strong>{{ number_format($reportSummary['today']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri Hadir</span>
      <strong>{{ number_format($reportSummary['present']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri Absen</span>
      <strong>{{ number_format($reportSummary['absent']) }}</strong>
    </article>
  </div>
</div>

<section class="dashboard-card admin-panel">
  <h3>Rekap Absensi Santri</h3>
  <p class="text-muted">Prioritaskan santri dengan rekap absensi terbaik untuk penilaian raport.</p>

  @if($santri->isEmpty())
    <div class="empty-state">Belum ada data santri untuk ditampilkan.</div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nama Santri</th>
            <th>Hadir</th>
            <th>Absen</th>
            <th>Telat</th>
            <th>Izin</th>
            <th>Menunggu</th>
          </tr>
        </thead>
        <tbody>
          @foreach($santri as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>{{ $student->present_count }}</td>
              <td>{{ $student->absent_count }}</td>
              <td>{{ $student->late_count }}</td>
              <td>{{ $student->permission_count }}</td>
              <td>{{ $student->pending_count }}</td>
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
