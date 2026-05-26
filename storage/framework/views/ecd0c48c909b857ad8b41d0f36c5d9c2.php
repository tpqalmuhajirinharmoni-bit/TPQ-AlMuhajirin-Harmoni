

<?php $__env->startSection('title', 'Data Wali Santri - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Data Wali Santri</h1>
      <p class="page-note">Cari dan tambahkan wali santri dengan cepat.</p>
    </div>
    <div class="top-actions">
      <button type="button" id="openAddGuardianModal" class="btn-primary">+ Tambah Wali Santri</button>
      <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Admin</a>
    </div>
  </div>

  <form method="GET" action="<?php echo e(route('data-wali-santri')); ?>" class="filter-bar">
    <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="<?php echo e(request('q')); ?>" class="form-control">
    <button type="submit" class="btn-primary">Cari</button>
  </form>

  <div id="addGuardianModal" class="modal-overlay" aria-hidden="true">
    <div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-header">
        <div>
          <h2 id="modalTitle" class="modal-title">Tambah Wali Santri</h2>
          <p class="modal-description">Isi data wali santri baru untuk ditambahkan ke sistem.</p>
        </div>
        <button type="button" class="modal-close" aria-label="Tutup">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.wali.store')); ?>">
          <?php echo csrf_field(); ?>

          <div class="modal-form-group">
            <label for="name">Nama Wali *</label>
            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required />
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="modal-form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>" />
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="modal-form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required />
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="modal-form-group">
            <label for="phone">Telepon</label>
            <input type="text" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" />
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="modal-actions">
            <button type="submit" class="btn-primary">Simpan Wali Santri</button>
            <button type="button" class="btn-cancel modal-close">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="table-container">
    <?php if($guardians->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $guardians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $guardian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($guardian->name); ?></td>
              <td><?php echo e($guardian->email); ?></td>
              <td><?php echo e($guardian->phone ?? '-'); ?></td>
              <td><?php echo e($guardian->created_at->format('d M Y')); ?></td>
              <td>
                <div class="action-buttons">
                  <a href="<?php echo e(route('edit-wali', $guardian)); ?>" class="btn-edit">Edit</a>
                  <form action="<?php echo e(route('delete-wali', $guardian)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data wali santri ini?');">
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
    <?php else: ?>
      <div class="empty-state">Belum ada data wali santri.</div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addGuardianModal');
    const openButton = document.getElementById('openAddGuardianModal');
    const closeButtons = modal ? modal.querySelectorAll('.modal-close') : [];

    function openModal() {
      if (!modal) return;
      modal.classList.add('active');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      if (!modal) return;
      modal.classList.remove('active');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    if (openButton) {
      openButton.addEventListener('click', openModal);
    }

    closeButtons.forEach(function (button) {
      button.addEventListener('click', closeModal);
    });

    if (modal) {
      modal.addEventListener('click', function (event) {
        if (event.target === modal) {
          closeModal();
        }
      });
    }

    <?php if($errors->any()): ?>
      openModal();
    <?php endif; ?>
  });
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-wali.blade.php ENDPATH**/ ?>