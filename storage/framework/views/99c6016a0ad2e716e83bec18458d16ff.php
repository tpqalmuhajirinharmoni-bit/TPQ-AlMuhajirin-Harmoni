

<?php $__env->startSection('title', 'Data Santri - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Data Santri</h2>
  <p>Daftar santri yang terdaftar di TPQ, ditampilkan langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Jumlah Santri</span>
      <strong><?php echo e(number_format($santri->count())); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Absensi</span>
      <strong><?php echo e(number_format($attendanceSummary['total'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Hadir</span>
      <strong><?php echo e(number_format($attendanceSummary['present'])); ?></strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Daftar Santri</h3>
  <?php if($santri->isEmpty()): ?>
    <p>Belum ada santri yang terdaftar.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Terdaftar</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $santri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($student->name); ?></td>
            <td><?php echo e($student->email); ?></td>
            <td><?php echo e($student->phone ?: '—'); ?></td>
            <td><?php echo e($student->created_at?->format('d M Y') ?? '—'); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\santri.blade.php ENDPATH**/ ?>