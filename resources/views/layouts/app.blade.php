<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'TPQ Al Muhajirin Harmoni')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  @stack('styles')
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="{{ route('home') }}" class="brand-logo" aria-label="TPQ Al Muhajirin Harmoni Logo">
        @if (file_exists(public_path('uploads/logo.png')))
          <img src="{{ asset('uploads/logo.png') }}" alt="TPQ Al Muhajirin Harmoni" class="brand-mark" />
        @else
          <img src="{{ asset('images/logo.svg') }}" alt="TPQ Al Muhajirin Harmoni" class="brand-mark" />
        @endif
      </a>
      <div class="brand-copy">
        <h1>TPQ Al Muhajirin Harmoni</h1>
        <p>Belajar Al-Qur'an dengan semangat harmoni islami</p>
      </div>
    </div>

    <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-label="Buka menu" aria-expanded="false" type="button">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="main-nav">
      <div class="nav-links">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('blog') }}">Berita</a>
        <a href="{{ route('ebook') }}">Ebook</a>
        <div class="nav-dropdown">
          <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
            Tentang TPQ
            <i class="fas fa-caret-down"></i>
          </button>
          <div class="dropdown-menu">
            <a href="{{ route('tpq.profile') }}">Profil TPQ</a>
            @auth
              <a href="{{ route('organization') }}">Struktur Organisasi</a>
            @endauth
            <a href="{{ route('documentation') }}">Dokumentasi</a>
          </div>
        </div>
        @auth
          <div class="nav-dropdown">
            <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
              Aplikasi
              <i class="fas fa-caret-down"></i>
            </button>
            <div class="dropdown-menu">
              <a href="{{ route('finance') }}">Keuangan</a>
              <a href="{{ route('teachers') }}">Guru</a>
              @unless(auth()->user()->hasRole('wali-santri'))
                <a href="{{ route('santri') }}">Santri</a>
                <a href="{{ route('evaluation') }}">Evaluasi</a>
              @endunless
            </div>
          </div>
        @endauth
        <a href="{{ route('contact') }}">Hubungi Kami</a>
      </div>

      <div class="nav-actions">
        @auth
          @php
            $isRealAdmin = auth()->user()->roles()->where('slug', 'admin')->exists();
            $notificationCount = \Illuminate\Support\Facades\Schema::hasTable('notifications') ? auth()->user()->unreadNotifications()->count() : 0;
            $recentNotifications = \Illuminate\Support\Facades\Schema::hasTable('notifications') ? auth()->user()->notifications()->limit(10)->get() : collect();
          @endphp

          <div class="notification-dropdown">
            <button class="notification-toggle button secondary" type="button" aria-haspopup="true" aria-expanded="false" aria-label="Notifikasi">
              <i class="fas fa-bell"></i>
              @if($notificationCount > 0)
                <span class="notification-badge">{{ $notificationCount }}</span>
              @endif
            </button>
            <div class="notification-menu">
              <div class="notification-menu-header">
                <span>Notifikasi Terbaru</span>
                <span class="notification-menu-count">{{ $recentNotifications->count() }}/10</span>
              </div>
              <div class="notification-items">
                @forelse($recentNotifications as $notification)
                  <a href="{{ route('notifications') }}" class="notification-item{{ $notification->read_at ? '' : ' unread' }}">
                    <div class="notification-item-title">{{ Str::limit($notification->title, 60) }}</div>
                    <div class="notification-item-meta">{{ $notification->created_at->format('d M Y H:i') }} @if(! $notification->read_at) · Baru @endif</div>
                  </a>
                @empty
                  <div class="notification-empty">Tidak ada notifikasi terbaru.</div>
                @endforelse
              </div>
              <a href="{{ route('notifications') }}" class="button view-all-notifications">Lihat notifikasi selengkapnya</a>
            </div>
          </div>

          <div class="profile-dropdown">
            <button class="profile-toggle" type="button">
              <i class="fas fa-user-circle"></i>
              <span>Hai..! {{ auth()->user()->name }}</span>
              <i class="fas fa-caret-down"></i>
            </button>
            <div class="profile-menu">
              <div class="dropdown-user-card">
                <div class="dropdown-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                <div>
                  <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                  <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                </div>
              </div>
              <a href="{{ route('profile') }}">Lihat Profil</a>
              <a href="{{ auth()->user()->hasRole('admin') ? route('admin') : route('dashboard') }}">Dashboard</a>
              <a href="{{ route('forum') }}">Forum</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="button">Keluar</button>
              </form>
            </div>
          </div>
        @else
          <button id="open-login" class="button secondary">Login</button>
        @endauth
      </div>
    </nav>
  </header>

  <main class="page-content">
    @yield('content')
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 TPQ Al Muhajirin Harmoni | Harmoni dalam Iman dan Ilmu</p>
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
  @include('auth.modal-login')
  @stack('scripts')
</body>
</html>
