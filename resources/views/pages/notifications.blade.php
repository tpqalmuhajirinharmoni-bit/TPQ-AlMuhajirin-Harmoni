@extends('layouts.app')

@section('title', 'Notifikasi Saya - TPQ Al Muhajirin Harmoni')

@section('content')
  <div class="notification-page">
    <div class="notification-page-header">
      <div>
        <h1 class="notification-card-title">Notifikasi Saya</h1>
        <p class="paragraph-muted">Menampilkan notifikasi terbaru untuk akun Anda.</p>
      </div>

      <div class="notification-page-actions">
        @if($unreadCount > 0)
          <form method="POST" action="{{ route('notifications.read-all') }}" class="form-inline">
            @csrf
            <button type="submit" class="button button-success button-tight">Tandai Semua Dibaca</button>
          </form>
        @endif
      </div>
    </div>

    @if($notifications->isEmpty())
      <div class="alert-box info">
        Tidak ada notifikasi untuk ditampilkan.
      </div>
    @else
      <div class="dashboard-grid">
        @foreach($notifications as $notification)
          <div class="notification-card {{ $notification->read_at ? 'read' : 'unread' }}">
            <div class="notification-card-header">
              <div>
                <h2 class="notification-card-title">{{ $notification->title }}</h2>
                <p class="notification-card-meta">{{ $notification->created_at->format('d M Y H:i') }} @if(! $notification->read_at) · Baru @endif</p>
              </div>
              @if(! $notification->read_at)
                <form method="POST" action="{{ route('notifications.read', $notification) }}" class="form-inline">
                  @csrf
                  <button type="submit" class="button button-tight">Tandai Dibaca</button>
                </form>
              @endif
            </div>
            @if($notification->body)
              <p class="notification-card-body">{{ $notification->body }}</p>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
