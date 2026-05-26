@extends('layouts.app')

@section('title', 'Login - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Silahkan Login.</h2>
  
  @if ($errors->has('login'))
    <div class="error-message-box">
      <strong>Gagal masuk: </strong> {{ $errors->first('login') }}
      <div class="error-message-hint">
        Saran: Periksa kembali Email/Username dan Password Anda, pastikan Caps Lock mati, atau gunakan fitur <a href="/password/reset">Lupa Password</a> jika diperlukan.
      </div>
    </div>
  @elseif ($errors->any())
    <div class="error-message-box">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('login.post') }}" class="card-form">
    @csrf

    <label>
      Email atau Username
      <input 
        type="text" 
        name="username" 
        value="{{ old('username') }}"
        placeholder="Email atau Username" 
        required 
        autofocus
      />
    </label>

    <label>
      Kata Sandi
      <input 
        type="password" 
        name="password" 
        placeholder="Kata sandi" 
        required 
      />
    </label>

    <p class="form-note">
      Silahkan login menggunakan Email/Username dan Password.
    </p>

    <label class="checkbox-label">
      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
      <span>Ingat saya</span>
    </label>

    <div class="form-actions">
      <button type="submit" class="button">Masuk</button>
      <a href="{{ route('home') }}" class="button secondary">Batal</a>
    </div>
  </form>

  <p class="form-note">
    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>.
  </p>
</section>
@endsection
