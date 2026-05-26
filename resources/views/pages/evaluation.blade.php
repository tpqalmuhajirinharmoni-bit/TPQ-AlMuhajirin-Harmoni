@extends('layouts.app')

@section('title', 'Evaluasi - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Evaluasi Kinerja</h2>
  <p>Ringkasan evaluasi kehadiran dan jadwal yang diambil langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Total Absensi</span>
      <strong>{{ number_format($attendanceSummary['total']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Hadir</span>
      <strong>{{ number_format($attendanceSummary['present']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Absen</span>
      <strong>{{ number_format($attendanceSummary['absent']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Terlambat</span>
      <strong>{{ number_format($attendanceSummary['late']) }}</strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Status Jadwal</h3>
  <p>Jumlah jadwal pelajaran yang tercatat: <strong>{{ number_format($scheduleCount) }}</strong></p>
  @if($topActivities->isNotEmpty())
    <ul style="padding-left: 1.2rem; margin-top: 1rem;">
      @foreach($topActivities as $activity)
        <li>{{ $activity->activity }} — {{ number_format($activity->total) }} jadwal</li>
      @endforeach
    </ul>
  @else
    <p>Tidak ada jadwal aktivitas yang tercatat saat ini.</p>
  @endif
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Absensi Terakhir</h3>
  @if($recentAttendances->isEmpty())
    <p>Tidak ada data absensi terbaru.</p>
  @else
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Santri</th>
          <th>Status</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recentAttendances as $attendance)
          <tr>
            <td>{{ $attendance->date?->format('d M Y') ?? '—' }}</td>
            <td>{{ $attendance->user?->name ?? 'Unknown' }}</td>
            <td>{{ ucfirst($attendance->status) }}</td>
            <td>{{ $attendance->note ?: '—' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
