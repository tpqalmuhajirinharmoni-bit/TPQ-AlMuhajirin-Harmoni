

<?php $__env->startSection('title', 'Evaluasi - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Evaluasi Kinerja</h2>
  <p>Ringkasan evaluasi kehadiran dan jadwal yang diambil langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Total Absensi</span>
      <strong><?php echo e(number_format($attendanceSummary['total'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Hadir</span>
      <strong><?php echo e(number_format($attendanceSummary['present'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Absen</span>
      <strong><?php echo e(number_format($attendanceSummary['absent'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Terlambat</span>
      <strong><?php echo e(number_format($attendanceSummary['late'])); ?></strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Status Jadwal</h3>
  <p>Jumlah jadwal pelajaran yang tercatat: <strong><?php echo e(number_format($scheduleCount)); ?></strong></p>
  <?php if($topActivities->isNotEmpty()): ?>
    <ul style="padding-left: 1.2rem; margin-top: 1rem;">
      <?php $__currentLoopData = $topActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($activity->activity); ?> — <?php echo e(number_format($activity->total)); ?> jadwal</li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  <?php else: ?>
    <p>Tidak ada jadwal aktivitas yang tercatat saat ini.</p>
  <?php endif; ?>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Absensi Terakhir</h3>
  <?php if($recentAttendances->isEmpty()): ?>
    <p>Tidak ada data absensi terbaru.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Santri</th>
          <th>Status</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($attendance->date?->format('d M Y') ?? '—'); ?></td>
            <td><?php echo e($attendance->user?->name ?? 'Unknown'); ?></td>
            <td><?php echo e(ucfirst($attendance->status)); ?></td>
            <td><?php echo e($attendance->note ?: '—'); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\evaluation.blade.php ENDPATH**/ ?>