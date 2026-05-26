@extends('layouts.app')

@section('title', 'Dashboard - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="dashboard-header">
  <h2>Dashboard {{ $roleLabel }}</h2>
  <p>Ringkasan informasi dan akses cepat yang disesuaikan dengan peran Anda di TPQ.</p>
</section>

<div class="dashboard-grid">
  <div class="dashboard-card">
    <h3>Ringkasan Utama</h3>
    <div class="dashboard-summary">
      <div>
        <strong>{{ number_format($commonCounts['santri']) }}</strong>
        <p>Santri Terdaftar</p>
      </div>
      <div>
        <strong>{{ number_format($commonCounts['guru']) }}</strong>
        <p>Guru Pengajar</p>
      </div>
      <div>
        <strong>{{ number_format($commonCounts['classrooms']) }}</strong>
        <p>Kelas Aktif</p>
      </div>
      <div>
        <strong>{{ number_format($commonCounts['documentation']) }}</strong>
        <p>Dokumentasi</p>
      </div>
    </div>

    @if($role === 'guru')
      <div class="section-grid section-spaced">
        <div>
          <strong>{{ number_format($classesCount) }}</strong>
          <p>Kelas yang Anda ajar</p>
        </div>
      </div>
    @elseif($role === 'santri')
      <div class="section-grid section-spaced">
        <div>
          <strong>{{ number_format($attendanceSummary['total']) }}</strong>
          <p>Catatan Absensi</p>
        </div>
      </div>
    @elseif($role === 'wali-santri')
      <div class="section-grid section-spaced">
        <div>
          <strong>{{ number_format($associatedStudentsCount) }}</strong>
          <p>Santri yang Anda dampingi</p>
        </div>
      </div>
    @endif
  </div>

  <aside class="dashboard-card">
    <h3>Notifikasi</h3>
    <p class="text-muted mb-1">{{ $unreadNotifications }} notifikasi belum dibaca.</p>
    @if($recentNotifications->isEmpty())
      <div class="notification-empty">Tidak ada notifikasi baru.</div>
    @else
      <div class="notification-items">
        @foreach($recentNotifications as $notification)
          <div class="notification-item{{ $notification->read_at ? '' : ' unread' }}">
            <div class="notification-item-title">{{ Str::limit($notification->title, 70) }}</div>
            <div class="notification-item-meta">{{ $notification->created_at->diffForHumans() }}</div>
          </div>
        @endforeach
      </div>
    @endif
    <a href="{{ route('notifications') }}" class="button view-all-notifications">Lihat Semua Notifikasi</a>
  </aside>
</div>

@if($role === 'guru')
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Kelas Anda</h3>
      @if($teacherClasses->isEmpty())
        <p>Belum ada kelas yang ditugaskan untuk Anda.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($teacherClasses as $classroom)
            <li class="dashboard-list-item">
              <strong>{{ $classroom->name }}</strong>
              <p class="text-muted-strong text-small">{{ Str::limit($classroom->description ?? 'Deskripsi belum tersedia.', 100) }}</p>
            </li>
          @endforeach
        </ul>
      @endif
    </div>

    <div class="dashboard-card">
      <h3>Detail Jadwal</h3>
      @if($recentSchedules->isEmpty())
        <p>Belum ada jadwal pelajaran untuk ditampilkan.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($recentSchedules as $schedule)
            <li class="dashboard-list-item-alt">
              <strong>{{ ucfirst($schedule->activity) }}</strong>
              <p>Hari {{ ucfirst($schedule->day) }} · {{ $schedule->time }}</p>
              <p class="text-small">Kelompok: {{ $schedule->group ?: 'Umum' }}</p>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
@endif

@if($role === 'santri')
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Ringkasan Absensi</h3>
      <div class="dashboard-summary">
        <div>
          <strong>{{ number_format($attendanceSummary['present']) }}</strong>
          <p>Hadir</p>
        </div>
        <div>
          <strong>{{ number_format($attendanceSummary['absent']) }}</strong>
          <p>Absen</p>
        </div>
        <div>
          <strong>{{ number_format($attendanceSummary['late']) }}</strong>
          <p>Terlambat</p>
        </div>
      </div>
    </div>

    <aside class="dashboard-card">
      <h3>Absensi Terakhir</h3>
      @if($userAttendances->isEmpty())
        <p>Belum ada catatan absensi.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($userAttendances as $attendance)
            <li class="dashboard-list-item-alt">
              <strong>{{ ucfirst($attendance->status ?: 'Tidak diketahui') }}</strong>
              <p>{{ $attendance->date->format('d M Y') }}</p>
              @if($attendance->note)
                <p class="text-small text-strong">{{ Str::limit($attendance->note, 100) }}</p>
              @endif
            </li>
          @endforeach
        </ul>
      @endif
    </aside>
  </div>
@endif

@if($role === 'wali-santri')
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Santri yang Anda Dampingi</h3>
      <p class="text-muted-strong mb-1">Jumlah santri yang tercatat dalam sistem sebagai berada di bawah pengawasan Anda.</p>
      <strong>{{ number_format($associatedStudentsCount) }}</strong>
    </div>

    <aside class="dashboard-card">
      <h3>Catatan Absensi Terkait</h3>
      @if($guardianAttendances->isEmpty())
        <p>Tidak ada catatan absensi untuk santri yang terhubung dengan informasi Anda.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($guardianAttendances as $attendance)
            <li class="dashboard-list-item-alt">
              <strong>{{ ucfirst($attendance->status ?: 'Tidak diketahui') }}</strong>
              <p>{{ $attendance->date->format('d M Y') }}</p>
              <p class="text-small text-strong">Santri ID: {{ $attendance->user_id }}</p>
            </li>
          @endforeach
        </ul>
      @endif
    </aside>
  </div>
@endif

@if(in_array($role, ['guru', 'santri', 'wali-santri'], true))
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Jadwal Pelajaran</h3>
      @if($recentSchedules->isEmpty())
        <p>Tidak ada jadwal tersedia saat ini.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($recentSchedules as $schedule)
            <li class="dashboard-list-item">
              <strong>{{ ucfirst($schedule->activity) }}</strong>
              <div class="text-strong text-small mt-1">Hari: {{ ucfirst($schedule->day) }} · Waktu: {{ $schedule->time }}</div>
              @if($schedule->group)
                <div class="text-muted text-small mt-1">Kelompok: {{ $schedule->group }}</div>
              @endif
            </li>
          @endforeach
        </ul>
      @endif
    </div>

    <div class="dashboard-card">
      <h3>Pengumuman Terbaru</h3>
      @if($recentAnnouncements->isEmpty())
        <p>Belum ada pengumuman terbaru.</p>
      @else
        <ul class="dashboard-card-list">
          @foreach($recentAnnouncements as $announcement)
            <li class="dashboard-list-item-alt">
              <strong>{{ Str::limit($announcement->title ?? 'Pengumuman TPQ', 70) }}</strong>
              <p class="text-small">{{ Str::limit($announcement->description ?? 'Tidak ada deskripsi.', 120) }}</p>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
@endif

@if($role === 'bendahara')
  <section class="dashboard-card section-spaced">
    <h3>Ringkasan Keuangan</h3>
    <div class="dashboard-summary-compact">
      <div>
        <strong>{{ number_format($financeSummary['incomeCount']) }}</strong>
        <p>Transaksi Keuangan</p>
      </div>
      <div>
        <strong>Rp {{ number_format($financeSummary['totalAmount'], 2, ',', '.') }}</strong>
        <p>Total Jumlah Transaksi</p>
      </div>
    </div>
  </section>
@endif

@if(in_array($role, ['pembina', 'penanggung-jawab', 'ketua', 'sekretaris'], true))
  <section class="dashboard-card section-spaced">
    <h3>Organisasi TPQ</h3>
    <p>Gunakan dashboard ini untuk mengakses informasi struktur organisasi, tugas, dan laporan.</p>
    <ul class="dashboard-info-list">
      <li>Jumlah Guru: {{ number_format($commonCounts['guru']) }}</li>
      <li>Jumlah Santri: {{ number_format($commonCounts['santri']) }}</li>
      <li>Kelas Aktif: {{ number_format($commonCounts['classrooms']) }}</li>
    </ul>
  </section>
@endif

@if($role === 'tamu')
  <section class="dashboard-card section-spaced">
    <h3>Selamat Datang</h3>
    <p>Dashboard Anda masih dalam tahapan awal. Silakan lengkapi profil dan peran untuk mendapatkan akses fitur yang sesuai.</p>
  </section>
@endif
@endsection
