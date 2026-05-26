

<?php $__env->startSection('title', 'Guru - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Guru TPQ</h2>
  <p>Informasi guru yang mengajar di TPQ, diperbarui dari data pengguna dan jadwal internal.</p>
</section>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Daftar Guru</h3>
  <?php if($teachers->isEmpty()): ?>
    <p>Tidak ada guru yang terdaftar saat ini.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Kelas Terpimpin</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($teacher->name); ?></td>
            <td><?php echo e($teacher->email); ?></td>
            <td><?php echo e($teacher->phone ?: '—'); ?></td>
            <td><?php echo e(number_format($teacher->class_count ?? 0)); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\teachers.blade.php ENDPATH**/ ?>