@extends('layouts.app')

@section('title', 'Data Santri - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Data Santri</h2>
  <p>Daftar santri yang terdaftar di TPQ, ditampilkan langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Jumlah Santri</span>
      <strong>{{ number_format($santri->count()) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Absensi</span>
      <strong>{{ number_format($attendanceSummary['total']) }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Hadir</span>
      <strong>{{ number_format($attendanceSummary['present']) }}</strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Daftar Santri</h3>
  @if($santri->isEmpty())
    <p>Belum ada santri yang terdaftar.</p>
  @else
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Terdaftar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($santri as $student)
          <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone ?: '—' }}</td>
            <td>{{ $student->created_at?->format('d M Y') ?? '—' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
