

<?php $__env->startSection('title', 'Ebook - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Ebook dan Dokumen Digital</h2>
  <p>Daftar buku digital dan panduan dalam bentuk dokumen untuk TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Ebook & Dokumen</h3>
  <p>Temukan materi pembelajaran, buku digital, dan dokumen penting yang dapat diunduh atau dibuka secara langsung.</p>
</div>

<div class="blog-list" style="margin-top: 2rem;">
  <?php $__empty_1 = true; $__currentLoopData = $ebooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ebook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="blog-card">
      <h3><?php echo e($ebook->title); ?></h3>
      <p class="post-meta">Ebook / Dokumen · <?php echo e($ebook->created_at->format('d M Y')); ?></p>
      <p><?php echo e($ebook->description); ?></p>

      <div style="margin-top: 1rem;">
        <a href="<?php echo e(Storage::url($ebook->file_path)); ?>" target="_blank" rel="noopener noreferrer" class="button">Buka / Unduh</a>
      </div>
      <?php if(in_array(pathinfo($ebook->file_path, PATHINFO_EXTENSION), ['pdf', 'epub'])): ?>
        <div style="margin-top: 1rem;">
          <iframe src="<?php echo e(Storage::url($ebook->file_path)); ?>" width="100%" height="450" style="border-radius: 20px; border: 1px solid #ddd;"></iframe>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="blog-card">
      <h3>Belum ada Ebook</h3>
      <p>Belum ada materi ebook yang tersedia. Silakan unggah ebook atau dokumen melalui dashboard admin.</p>
    </div>
  <?php endif; ?>
</div>

<div style="margin-top:1.5rem;"><?php echo e($ebooks->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\ebook.blade.php ENDPATH**/ ?>