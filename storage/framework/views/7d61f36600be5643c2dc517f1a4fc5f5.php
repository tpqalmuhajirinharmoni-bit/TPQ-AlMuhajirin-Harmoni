

<?php $__env->startSection('title', 'Raport Santri - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Raport Santri</h2>
  <p>Ringkasan kehadiran santri untuk mendukung pembuatan raport dan laporan akademik.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Santri Terdaftar</span>
      <strong><?php echo e(number_format($reportSummary['santri'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Absensi Hari Ini</span>
      <strong><?php echo e(number_format($reportSummary['today'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri Hadir</span>
      <strong><?php echo e(number_format($reportSummary['present'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri Absen</span>
      <strong><?php echo e(number_format($reportSummary['absent'])); ?></strong>
    </article>
  </div>
</div>

<section class="dashboard-card admin-panel">
  <h3>Rekap Absensi Santri</h3>
  <p class="text-muted">Prioritaskan santri dengan rekap absensi terbaik untuk penilaian raport.</p>

  <?php if($santri->isEmpty()): ?>
    <div class="empty-state">Belum ada data santri untuk ditampilkan.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nama Santri</th>
            <th>Hadir</th>
            <th>Absen</th>
            <th>Telat</th>
            <th>Izin</th>
            <th>Menunggu</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $santri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($student->name); ?></td>
              <td><?php echo e($student->present_count); ?></td>
              <td><?php echo e($student->absent_count); ?></td>
              <td><?php echo e($student->late_count); ?></td>
              <td><?php echo e($student->permission_count); ?></td>
              <td><?php echo e($student->pending_count); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div class="section-footer">
    <a href="<?php echo e(route('admin')); ?>" class="button">Kembali ke Dashboard Admin</a>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views/pages/raport.blade.php ENDPATH**/ ?>