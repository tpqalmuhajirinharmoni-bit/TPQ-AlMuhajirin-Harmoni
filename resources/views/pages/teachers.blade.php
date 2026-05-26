@extends('layouts.app')

@section('title', 'Guru - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Guru TPQ</h2>
  <p>Informasi guru yang mengajar di TPQ, diperbarui dari data pengguna dan jadwal internal.</p>
</section>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Daftar Guru</h3>
  @if($teachers->isEmpty())
    <p>Tidak ada guru yang terdaftar saat ini.</p>
  @else
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Kelas Terpimpin</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teachers as $teacher)
          <tr>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->phone ?: '—' }}</td>
            <td>{{ number_format($teacher->class_count ?? 0) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
