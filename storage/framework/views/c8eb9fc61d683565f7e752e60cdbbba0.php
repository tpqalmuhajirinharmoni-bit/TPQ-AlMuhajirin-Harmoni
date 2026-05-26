

<?php $__env->startSection('title', 'Prestasi Santri - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Prestasi Santri</h2>
  <p>Informasi prestasi santri dan rekomendasi penghargaan berbasis catatan kehadiran.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Prestasi Diverifikasi</span>
      <strong><?php echo e(number_format($achievementSummary['verified'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Pengajuan Baru</span>
      <strong><?php echo e(number_format($achievementSummary['pending'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Santri</span>
      <strong><?php echo e(number_format($santriTotal)); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Rekomendasi Teratas</span>
      <strong><?php echo e(number_format($topStudents->count())); ?></strong>
    </article>
  </div>
</div>

<section class="dashboard-card admin-panel">
  <h3>Santri dengan Kehadiran Terbaik</h3>
  <p class="text-muted">Rekap ini membantu menentukan santri berprestasi dari aspek ketepatan dan kehadiran.</p>

  <?php if($topStudents->isEmpty()): ?>
    <div class="empty-state">Belum ada data santri untuk rekomendasi prestasi.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nama Santri</th>
            <th>Hadir</th>
            <th>Absen</th>
            <th>Telat</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $topStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($student->name); ?></td>
              <td><?php echo e($student->present_count); ?></td>
              <td><?php echo e($student->absent_count); ?></td>
              <td><?php echo e($student->late_count); ?></td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\prestasi.blade.php ENDPATH**/ ?>