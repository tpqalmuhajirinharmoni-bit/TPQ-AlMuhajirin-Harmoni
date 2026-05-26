

<?php $__env->startSection('title', 'Dashboard - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="dashboard-header">
  <h2>Dashboard <?php echo e($roleLabel); ?></h2>
  <p>Ringkasan informasi dan akses cepat yang disesuaikan dengan peran Anda di TPQ.</p>
</section>

<div class="dashboard-grid">
  <div class="dashboard-card">
    <h3>Ringkasan Utama</h3>
    <div class="dashboard-summary">
      <div>
        <strong><?php echo e(number_format($commonCounts['santri'])); ?></strong>
        <p>Santri Terdaftar</p>
      </div>
      <div>
        <strong><?php echo e(number_format($commonCounts['guru'])); ?></strong>
        <p>Guru Pengajar</p>
      </div>
      <div>
        <strong><?php echo e(number_format($commonCounts['classrooms'])); ?></strong>
        <p>Kelas Aktif</p>
      </div>
      <div>
        <strong><?php echo e(number_format($commonCounts['documentation'])); ?></strong>
        <p>Dokumentasi</p>
      </div>
    </div>

    <?php if($role === 'guru'): ?>
      <div class="section-grid section-spaced">
        <div>
          <strong><?php echo e(number_format($classesCount)); ?></strong>
          <p>Kelas yang Anda ajar</p>
        </div>
      </div>
    <?php elseif($role === 'santri'): ?>
      <div class="section-grid section-spaced">
        <div>
          <strong><?php echo e(number_format($attendanceSummary['total'])); ?></strong>
          <p>Catatan Absensi</p>
        </div>
      </div>
    <?php elseif($role === 'wali-santri'): ?>
      <div class="section-grid section-spaced">
        <div>
          <strong><?php echo e(number_format($associatedStudentsCount)); ?></strong>
          <p>Santri yang Anda dampingi</p>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <aside class="dashboard-card">
    <h3>Notifikasi</h3>
    <p class="text-muted mb-1"><?php echo e($unreadNotifications); ?> notifikasi belum dibaca.</p>
    <?php if($recentNotifications->isEmpty()): ?>
      <div class="notification-empty">Tidak ada notifikasi baru.</div>
    <?php else: ?>
      <div class="notification-items">
        <?php $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="notification-item<?php echo e($notification->read_at ? '' : ' unread'); ?>">
            <div class="notification-item-title"><?php echo e(Str::limit($notification->title, 70)); ?></div>
            <div class="notification-item-meta"><?php echo e($notification->created_at->diffForHumans()); ?></div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
    <a href="<?php echo e(route('notifications')); ?>" class="button view-all-notifications">Lihat Semua Notifikasi</a>
  </aside>
</div>

<?php if($role === 'guru'): ?>
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Kelas Anda</h3>
      <?php if($teacherClasses->isEmpty()): ?>
        <p>Belum ada kelas yang ditugaskan untuk Anda.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $teacherClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item">
              <strong><?php echo e($classroom->name); ?></strong>
              <p class="text-muted-strong text-small"><?php echo e(Str::limit($classroom->description ?? 'Deskripsi belum tersedia.', 100)); ?></p>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>

    <div class="dashboard-card">
      <h3>Detail Jadwal</h3>
      <?php if($recentSchedules->isEmpty()): ?>
        <p>Belum ada jadwal pelajaran untuk ditampilkan.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $recentSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item-alt">
              <strong><?php echo e(ucfirst($schedule->activity)); ?></strong>
              <p>Hari <?php echo e(ucfirst($schedule->day)); ?> · <?php echo e($schedule->time); ?></p>
              <p class="text-small">Kelompok: <?php echo e($schedule->group ?: 'Umum'); ?></p>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

<?php if($role === 'santri'): ?>
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Ringkasan Absensi</h3>
      <div class="dashboard-summary">
        <div>
          <strong><?php echo e(number_format($attendanceSummary['present'])); ?></strong>
          <p>Hadir</p>
        </div>
        <div>
          <strong><?php echo e(number_format($attendanceSummary['absent'])); ?></strong>
          <p>Absen</p>
        </div>
        <div>
          <strong><?php echo e(number_format($attendanceSummary['late'])); ?></strong>
          <p>Terlambat</p>
        </div>
      </div>
    </div>

    <aside class="dashboard-card">
      <h3>Absensi Terakhir</h3>
      <?php if($userAttendances->isEmpty()): ?>
        <p>Belum ada catatan absensi.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $userAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item-alt">
              <strong><?php echo e(ucfirst($attendance->status ?: 'Tidak diketahui')); ?></strong>
              <p><?php echo e($attendance->date->format('d M Y')); ?></p>
              <?php if($attendance->note): ?>
                <p class="text-small text-strong"><?php echo e(Str::limit($attendance->note, 100)); ?></p>
              <?php endif; ?>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </aside>
  </div>
<?php endif; ?>

<?php if($role === 'wali-santri'): ?>
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Santri yang Anda Dampingi</h3>
      <p class="text-muted-strong mb-1">Jumlah santri yang tercatat dalam sistem sebagai berada di bawah pengawasan Anda.</p>
      <strong><?php echo e(number_format($associatedStudentsCount)); ?></strong>
    </div>

    <aside class="dashboard-card">
      <h3>Catatan Absensi Terkait</h3>
      <?php if($guardianAttendances->isEmpty()): ?>
        <p>Tidak ada catatan absensi untuk santri yang terhubung dengan informasi Anda.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $guardianAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item-alt">
              <strong><?php echo e(ucfirst($attendance->status ?: 'Tidak diketahui')); ?></strong>
              <p><?php echo e($attendance->date->format('d M Y')); ?></p>
              <p class="text-small text-strong">Santri ID: <?php echo e($attendance->user_id); ?></p>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </aside>
  </div>
<?php endif; ?>

<?php if(in_array($role, ['guru', 'santri', 'wali-santri'], true)): ?>
  <div class="dashboard-grid section-spaced">
    <div class="dashboard-card">
      <h3>Jadwal Pelajaran</h3>
      <?php if($recentSchedules->isEmpty()): ?>
        <p>Tidak ada jadwal tersedia saat ini.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $recentSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item">
              <strong><?php echo e(ucfirst($schedule->activity)); ?></strong>
              <div class="text-strong text-small mt-1">Hari: <?php echo e(ucfirst($schedule->day)); ?> · Waktu: <?php echo e($schedule->time); ?></div>
              <?php if($schedule->group): ?>
                <div class="text-muted text-small mt-1">Kelompok: <?php echo e($schedule->group); ?></div>
              <?php endif; ?>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>

    <div class="dashboard-card">
      <h3>Pengumuman Terbaru</h3>
      <?php if($recentAnnouncements->isEmpty()): ?>
        <p>Belum ada pengumuman terbaru.</p>
      <?php else: ?>
        <ul class="dashboard-card-list">
          <?php $__currentLoopData = $recentAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="dashboard-list-item-alt">
              <strong><?php echo e(Str::limit($announcement->title ?? 'Pengumuman TPQ', 70)); ?></strong>
              <p class="text-small"><?php echo e(Str::limit($announcement->description ?? 'Tidak ada deskripsi.', 120)); ?></p>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

<?php if($role === 'bendahara'): ?>
  <section class="dashboard-card section-spaced">
    <h3>Ringkasan Keuangan</h3>
    <div class="dashboard-summary-compact">
      <div>
        <strong><?php echo e(number_format($financeSummary['incomeCount'])); ?></strong>
        <p>Transaksi Keuangan</p>
      </div>
      <div>
        <strong>Rp <?php echo e(number_format($financeSummary['totalAmount'], 2, ',', '.')); ?></strong>
        <p>Total Jumlah Transaksi</p>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if(in_array($role, ['pembina', 'penanggung-jawab', 'ketua', 'sekretaris'], true)): ?>
  <section class="dashboard-card section-spaced">
    <h3>Organisasi TPQ</h3>
    <p>Gunakan dashboard ini untuk mengakses informasi struktur organisasi, tugas, dan laporan.</p>
    <ul class="dashboard-info-list">
      <li>Jumlah Guru: <?php echo e(number_format($commonCounts['guru'])); ?></li>
      <li>Jumlah Santri: <?php echo e(number_format($commonCounts['santri'])); ?></li>
      <li>Kelas Aktif: <?php echo e(number_format($commonCounts['classrooms'])); ?></li>
    </ul>
  </section>
<?php endif; ?>

<?php if($role === 'tamu'): ?>
  <section class="dashboard-card section-spaced">
    <h3>Selamat Datang</h3>
    <p>Dashboard Anda masih dalam tahapan awal. Silakan lengkapi profil dan peran untuk mendapatkan akses fitur yang sesuai.</p>
  </section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\dashboard.blade.php ENDPATH**/ ?>