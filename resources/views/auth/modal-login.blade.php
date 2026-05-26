<div id="login-modal" class="modal" aria-hidden="true" aria-modal="true" role="dialog" aria-labelledby="login-modal-title" tabindex="-1">
  <div class="modal-overlay" data-action="close"></div>
  <div class="modal-panel" role="document">
    <button class="modal-close" data-action="close" aria-label="Tutup">&times;</button>
    <div class="modal-content">
      <h3 id="login-modal-title" class="modal-title">Silahkan Login.</h3>
      <p class="modal-subtitle">Masukkan email atau username dan kata sandi Anda untuk mengakses akun.</p>

      @if ($errors->has('login'))
        <div class="modal-error">
          <strong>Gagal masuk:</strong> {{ $errors->first('login') }}
          <div class="modal-error-suggestion">Saran: Periksa kembali Email/Username dan Password, cek Caps Lock, atau gunakan <a href="/password/reset">Lupa Password</a>.</div>
        </div>
      @elseif ($errors->any())
        <div class="modal-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}" class="modal-form">
        @csrf

        <label class="modal-label">
          Email atau Username
          <input type="text" name="username" value="{{ old('username') }}" placeholder="Email atau Username" required autofocus />
        </label>

        <label class="modal-label">
          Kata Sandi
          <input type="password" name="password" placeholder="Kata sandi" required />
        </label>

        <label class="modal-remember">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} /> Ingat saya
        </label>

        <div class="modal-actions">
          <button type="submit" class="button button-primary">Masuk</button>
          <a href="{{ route('register') }}" class="button button-ghost">Daftar</a>
          <button type="button" class="button secondary" data-action="close">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
