@extends('layouts.app')

@section('title', 'Daftar Akun - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Daftar Akun Baru</h2>

  @if ($errors->any())
    <div class="error-message-box">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('register.post') }}" class="card-form">
    @csrf

    <label>
      Nama Lengkap
      <input
        type="text"
        name="name"
        value="{{ old('name') }}"
        placeholder="Nama lengkap"
        required
        autofocus
      />
    </label>

    <label>
      Nama Pengguna
      <input
        type="text"
        name="username"
        value="{{ old('username') }}"
        placeholder="contoh: nurul"
        required
      />
    </label>

    <label>
      Email
      <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="email@contoh.com"
        required
      />
    </label>

    <label>
      Hak Akses
      <select name="role" required>
        <option value="">Pilih hak akses...</option>
        @foreach ($roles as $role)
          <option value="{{ $role->slug }}" {{ old('role') === $role->slug ? 'selected' : '' }}>
            {{ $role->name }}
          </option>
        @endforeach
      </select>
    </label>

    <label>
      Kata Sandi
      <input
        type="password"
        name="password"
        placeholder="Minimal 8 karakter"
        required
      />
    </label>

    <label>
      Konfirmasi Kata Sandi
      <input
        type="password"
        name="password_confirmation"
        placeholder="Ulangi kata sandi"
        required
      />
    </label>

    <div>
      <button type="submit" class="button">Daftar</button>
      <a href="{{ route('login') }}" class="button secondary">Sudah punya akun?</a>
    </div>
  </form>
</section>
@endsection
