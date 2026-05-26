@extends('layouts.app')

@section('title', 'Pendaftaran Santri - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Pendaftaran Santri Baru</h2>
  <p>Daftar menjadi santri di TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 600px; margin: 2rem auto;">
  <form>
    <label>
      Nama Lengkap
      <input type="text" placeholder="Nama santri" required />
    </label>
    <label>
      Tempat, Tanggal Lahir
      <input type="text" placeholder="Tempat, DD/MM/YYYY" required />
    </label>
    <label>
      Nama Orang Tua
      <input type="text" placeholder="Orang tua/wali" required />
    </label>
    <label>
      Nomor Telepon
      <input type="tel" placeholder="+62..." required />
    </label>
    <label>
      Alamat
      <textarea placeholder="Alamat lengkap" rows="3" required></textarea>
    </label>
    <div>
      <button type="submit" class="button">Daftar</button>
      <a href="{{ route('home') }}" class="button secondary">Batal</a>
    </div>
  </form>
</div>
@endsection
