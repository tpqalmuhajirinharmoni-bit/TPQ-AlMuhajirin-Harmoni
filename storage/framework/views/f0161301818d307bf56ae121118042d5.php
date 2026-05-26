

<?php $__env->startSection('title', 'Blog - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Blog TPQ Al Muhajirin Harmoni</h2>
  <p>Artikel dan berita seputar pembelajaran Al-Qur'an.</p>
</section>

<div class="blog-list">
  <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="blog-card">
      <h3><?php echo e($post->title); ?></h3>
      <p class="post-meta"><?php echo e(optional($post->published_at ?? $post->created_at)->format('d M Y')); ?> · <?php echo e($post->summary ? 'Ringkasan' : 'Postingan singkat'); ?></p>
      <p><?php echo e($post->summary ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 180)); ?></p>
    </article>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="blog-card">
      <h3>Belum ada artikel</h3>
      <p>Postingan blog belum tersedia. Silakan buat posting baru dari dashboard admin.</p>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\blog.blade.php ENDPATH**/ ?>