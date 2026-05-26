

<?php $__env->startSection('title', 'Data Guru - Admin'); ?>

<?php $__env->startSection('content'); ?>
  <div class="data-page">
    <div class="page-header">
      <div>
        <h2>Data Guru</h2>
        <p class="page-note">Kelola data guru dan cari informasi dengan mudah.</p>
      </div>
      <div class="top-actions">
        <button id="open-create-guru-modal" class="button primary" type="button">+ Tambah Guru</button>
        <a href="<?php echo e(route('admin')); ?>" class="button secondary">← Kembali ke Dashboard</a>
      </div>
    </div>

    <div id="create-guru-modal" class="modal-overlay">
      <div class="modal-card sm">
        <button id="close-create-guru-modal" type="button" class="modal-close">&times;</button>
        <h3 class="modal-title">Tambah Guru Baru</h3>
        <form method="POST" action="<?php echo e(route('admin.guru.store')); ?>" class="form-grid">
          <?php echo csrf_field(); ?>
          <div class="form-columns">
            <input type="text" name="name" placeholder="Nama Guru" required class="form-control">
            <input type="text" name="username" placeholder="Username Guru" class="form-control">
          </div>
          <div class="form-columns">
            <input type="email" name="email" placeholder="Email Guru" class="form-control">
            <input type="text" name="specialty" placeholder="Mata Pelajaran" class="form-control">
          </div>
          <input type="text" name="contact" placeholder="Kontak Guru" class="form-control">
          <div class="form-row">
            <button type="button" id="cancel-create-guru-modal" class="button secondary cancel">Batal</button>
            <button type="submit" class="button primary">Simpan Guru</button>
          </div>
        </form>
      </div>
    </div>

    <form method="GET" action="<?php echo e(route('data-guru')); ?>" class="filter-bar">
      <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="<?php echo e(request('q')); ?>" class="form-control">
      <button type="submit" class="button primary">Cari</button>
    </form>

    <div class="table-container">
      <?php if($guru->isEmpty()): ?>
        <div class="empty-state">Belum ada data guru.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Dibuat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($g->name); ?></td>
                <td><?php echo e($g->username); ?></td>
                <td><?php echo e($g->email); ?></td>
                <td><?php echo e($g->created_at->format('d M Y')); ?></td>
                <td><a href="<?php echo e(route('edit-guru', $g)); ?>">Edit</a></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-guru-modal');
    const closeModal = document.getElementById('close-create-guru-modal');
    const cancelModal = document.getElementById('cancel-create-guru-modal');
    const modal = document.getElementById('create-guru-modal');

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-guru.blade.php ENDPATH**/ ?>