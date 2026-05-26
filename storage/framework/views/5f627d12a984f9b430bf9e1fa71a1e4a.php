

<?php $__env->startSection('title', 'Manajemen Aset - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <h1>Manajemen Aset</h1>
    <div class="top-actions">
      <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Admin</a>
      <button id="open-create-asset-modal" class="btn-primary" type="button">+ Tambah Aset</button>
    </div>
  </div>

  <div id="create-asset-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-create-asset-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Tambah Aset Baru</h2>
      <form method="POST" action="<?php echo e(route('store-asset')); ?>" enctype="multipart/form-data" class="form-grid">
        <?php echo csrf_field(); ?>
        <div class="form-columns">
          <input type="text" name="title" placeholder="Judul aset" required class="form-control">
          <select name="type" required class="form-control">
            <option value="">Pilih tipe aset</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="ebook">Ebook</option>
          </select>
        </div>
        <input type="text" name="tags" placeholder="Tag (pisah koma)" class="form-control">
        <textarea name="description" rows="3" placeholder="Deskripsi singkat" class="form-control"></textarea>
        <input type="file" name="file" required class="form-control file">
        <div class="form-row">
          <button type="button" id="cancel-create-asset-modal" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Simpan Aset</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="<?php echo e(route('data-assets')); ?>" class="filter-bar">
    <input type="text" name="q" placeholder="Cari judul..." value="<?php echo e(request('q')); ?>" class="form-control">
    <select name="type" class="form-control">
      <option value="">Semua tipe</option>
      <option value="image" <?php echo e(request('type') === 'image' ? 'selected' : ''); ?>>Image</option>
      <option value="video" <?php echo e(request('type') === 'video' ? 'selected' : ''); ?>>Video</option>
      <option value="ebook" <?php echo e(request('type') === 'ebook' ? 'selected' : ''); ?>>Ebook</option>
    </select>
    <input type="text" name="tags" placeholder="Tag (pisah koma)" value="<?php echo e(request('tags')); ?>" class="form-control">
    <button class="btn-primary compact">Filter</button>
  </form>

  <?php if(session('success')): ?>
    <div class="success-message"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <div class="table-container">
    <?php if($assets->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tipe</th>
            <th>Uploaded</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($item->title); ?></td>
              <td><?php echo e(ucfirst($item->type)); ?></td>
              <td><?php echo e($item->created_at->format('d M Y H:i')); ?></td>
              <td>
                <div class="table-actions">
                  <?php $__currentLoopData = $item->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge-pill"><?php echo e($tag->name); ?></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="action-buttons">
                  <?php if(!empty($item->file_path)): ?>
                    <a href="<?php echo e(route('download-asset', $item)); ?>" class="btn-download">Download</a>
                  <?php endif; ?>
                  <a href="<?php echo e(route('edit-asset', $item)); ?>" class="btn-edit">Edit</a>
                  <form action="<?php echo e(route('delete-asset', $item)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus aset ini?');" class="inline-block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <div class="pagination-wrapper"><?php echo e($assets->appends(request()->all())->links()); ?></div>
    <?php else: ?>
      <div class="empty-state">Belum ada aset terunggah.</div>
    <?php endif; ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-asset-modal');
    const closeModal = document.getElementById('close-create-asset-modal');
    const cancelModal = document.getElementById('cancel-create-asset-modal');
    const modal = document.getElementById('create-asset-modal');

    if (openModal) {
      openModal.addEventListener('click', function () {
        modal.style.display = 'flex';
      });
    }

    if (closeModal) {
      closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }

    if (cancelModal) {
      cancelModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }

    if (modal) {
      modal.addEventListener('click', function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-assets.blade.php ENDPATH**/ ?>