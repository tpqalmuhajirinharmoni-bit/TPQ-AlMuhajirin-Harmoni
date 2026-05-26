

<?php $__env->startSection('title', 'Data User - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Data User</h1>
      <p class="page-note">Tambahkan, cari, dan kirim pesan cepat ke user.</p>
    </div>
    <div class="top-actions">
      <button id="open-create-user-modal" class="btn-primary" type="button">+ Tambah User</button>
      <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Admin</a>
    </div>
  </div>

  <div id="create-user-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-create-user-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Tambah User Baru</h2>
      <form method="POST" action="<?php echo e(route('admin.user.store')); ?>" class="form-grid">
        <?php echo csrf_field(); ?>
        <div class="form-columns">
          <input type="text" name="name" placeholder="Nama" value="<?php echo e(old('name')); ?>" required class="form-control">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="form-error"><?php echo e($message); ?></div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-columns">
          <input type="text" name="username" placeholder="Username" value="<?php echo e(old('username')); ?>" class="form-control">
          <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required class="form-control">
        </div>
        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="form-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="form-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <div class="form-columns">
          <select name="role" required class="form-control">
            <option value="">Pilih role...</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($role->slug); ?>" <?php echo e(old('role') == $role->slug ? 'selected' : ''); ?>><?php echo e(ucfirst(str_replace('-', ' ', $role->name))); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="form-error"><?php echo e($message); ?></div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-row">
          <button id="cancel-create-user-modal" type="button" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Buat User</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="<?php echo e(route('data-user')); ?>" class="filter-bar">
    <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="<?php echo e(request('q')); ?>" class="form-control">
    <button type="submit" class="btn-primary">Cari</button>
  </form>

  <?php if(session('success')): ?>
    <div class="success-message">
      <?php echo e(session('success')); ?>

    </div>
  <?php endif; ?>

  <div class="table-container">
    <?php if($users->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($user->name); ?></td>
              <td><?php echo e($user->email); ?></td>
              <td>
                <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="badge badge-<?php echo e($role->slug); ?>">
                    <?php echo e(ucfirst(str_replace('-', ' ', $role->name))); ?>

                  </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </td>
              <td><?php echo e($user->created_at->format('d M Y')); ?></td>
              <td>
                <div class="action-buttons">
                  <a href="mailto:<?php echo e($user->email); ?>" class="btn-download btn-mail">Kirim Pesan</a>
                  <a href="<?php echo e(route('edit-user', $user)); ?>" class="btn-edit">Edit</a>
                  <form method="POST" action="<?php echo e(route('delete-user', $user)); ?>" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
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
      <div class="empty-state">
        <p>Belum ada data user.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-user-modal');
    const closeModal = document.getElementById('close-create-user-modal');
    const cancelModal = document.getElementById('cancel-create-user-modal');
    const modal = document.getElementById('create-user-modal');

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



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-user.blade.php ENDPATH**/ ?>