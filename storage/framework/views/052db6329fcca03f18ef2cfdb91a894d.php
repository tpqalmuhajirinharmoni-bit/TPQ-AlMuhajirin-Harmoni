

<?php $__env->startSection('title', isset($asset) ? 'Edit Aset - Admin' : 'Tambah Aset - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="form-page">
  <div class="page-header">
    <h1><?php echo e(isset($asset) ? 'Edit Aset' : 'Tambah Aset'); ?></h1>
    <a href="<?php echo e(route('data-assets')); ?>" class="btn-cancel">← Kembali</a>
  </div>

  <?php if($errors->any()): ?>
    <div class="alert-box">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="form-card">
    <?php if(isset($asset)): ?>
      <form action="<?php echo e(route('update-asset', $asset)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
    <?php else: ?>
      <form action="<?php echo e(route('store-asset')); ?>" method="POST" enctype="multipart/form-data">
    <?php endif; ?>
      <?php echo csrf_field(); ?>

      <label for="title">Judul</label>
      <input type="text" id="title" name="title" value="<?php echo e(old('title', $asset->title ?? '')); ?>" required>

      <label for="type">Tipe</label>
      <select id="type" name="type" required>
        <option value="image" <?php echo e(old('type', $asset->type ?? '') === 'image' ? 'selected' : ''); ?>>Image</option>
        <option value="video" <?php echo e(old('type', $asset->type ?? '') === 'video' ? 'selected' : ''); ?>>Video</option>
        <option value="ebook" <?php echo e(old('type', $asset->type ?? '') === 'ebook' ? 'selected' : ''); ?>>Ebook / Dokumen</option>
      </select>

      <label for="description">Deskripsi (opsional)</label>
      <textarea id="description" name="description" rows="4"><?php echo e(old('description', $asset->description ?? '')); ?></textarea>

      <label for="tags">Tag (pisah koma)</label>
      <input type="text" id="tags" name="tags" value="<?php echo e(old('tags', isset($asset) ? $asset->tags->pluck('name')->implode(', ') : '')); ?>">

      <label for="storage_disk">Penyimpanan</label>
      <select id="storage_disk" name="storage_disk">
        <option value="public" <?php echo e(old('storage_disk', $asset->storage_disk ?? 'public') === 'public' ? 'selected' : ''); ?>>Local (public)</option>
        <option value="s3" <?php echo e(old('storage_disk', $asset->storage_disk ?? '') === 's3' ? 'selected' : ''); ?>>Amazon S3</option>
      </select>

      <label for="file">File <?php echo e(isset($asset) ? '(unggah untuk mengganti)' : ''); ?></label>
      <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.epub,.doc,.docx,.txt">

      <?php if(isset($asset) && !empty($asset->file_path)): ?>
        <div class="preview">
          <?php if($asset->type === 'image'): ?>
            <img src="<?php echo e(asset('storage/' . $asset->file_path)); ?>" alt="preview">
          <?php else: ?>
            <video controls>
              <source src="<?php echo e(asset('storage/' . $asset->file_path)); ?>" />
              Your browser does not support the video tag.
            </video>
          <?php endif; ?>
        </div>
        <?php if($asset->versions->count() > 0): ?>
          <div class="version-box">
            <h3>Versi Sebelumnya</h3>
            <ul class="version-list">
              <?php $__currentLoopData = $asset->versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="version-item">
                  <strong>v<?php echo e($version->id); ?></strong> — <?php echo e($version->created_at->format('d M Y H:i')); ?>

                  <a href="<?php echo e(route('download-asset-version', [$asset, $version->id])); ?>" class="version-link">Download</a>
                  <form method="POST" action="<?php echo e(route('rollback-asset-version', [$asset, $version->id])); ?>" class="version-form">
                    <?php echo csrf_field(); ?>
                    <button type="submit" onclick="return confirm('Rollback ke versi ini?')" class="version-button">Rollback</button>
                  </form>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="button-group">
        <button type="submit" class="btn-submit"><?php echo e(isset($asset) ? 'Simpan Perubahan' : 'Unggah Aset'); ?></button>
        <a href="<?php echo e(route('data-assets')); ?>" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-asset.blade.php ENDPATH**/ ?>