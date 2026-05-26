

<?php $__env->startSection('title', 'Dokumentasi - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Dokumentasi Sistem</h2>
  <p>Panduan dan dokumentasi kegiatan TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Panduan Sistem</h3>
  <p>Di halaman ini Anda dapat melihat dokumentasi operasional, panduan penggunaan sistem, dan dokumentasi kegiatan TPQ dalam bentuk foto maupun video.</p>
</div>

<div class="blog-list" style="margin-top: 2rem;">
  <?php $__empty_1 = true; $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="blog-card">
      <h3><?php echo e($item->title); ?></h3>
      <p class="post-meta"><?php echo e($item->type === 'video' ? 'Video dokumentasi' : 'Gambar dokumentasi'); ?> · <?php echo e($item->created_at->format('d M Y')); ?></p>
      <p><?php echo e($item->description); ?></p>
      <?php if($item->type === 'image'): ?>
        <img src="<?php echo e(Storage::url($item->file_path)); ?>" alt="<?php echo e($item->title); ?>" style="max-width: 100%; border-radius: 20px; margin-top: 1rem;" />
      <?php else: ?>
        <video controls style="width: 100%; border-radius: 20px; margin-top: 1rem;">
          <source src="<?php echo e(Storage::url($item->file_path)); ?>" type="video/<?php echo e(pathinfo($item->file_path, PATHINFO_EXTENSION)); ?>" />
          Browser Anda tidak mendukung pemutaran video.
        </video>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="blog-card">
      <h3>Belum ada dokumentasi</h3>
      <p>Silakan unggah file dokumentasi di dashboard admin untuk melihat panduan penggunaan sistem.</p>
    </div>
  <?php endif; ?>
</div>
<div style="margin-top:1.5rem;"><?php echo e($media->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\documentation.blade.php ENDPATH**/ ?>