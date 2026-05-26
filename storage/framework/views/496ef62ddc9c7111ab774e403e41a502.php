

<?php $__env->startSection('title', 'Edit Data Guru'); ?>

<?php $__env->startSection('content'); ?>

<div class="form-page">
  <div class="form-header">
    <h1>Edit Data Guru</h1>
    <p>Perbarui informasi guru</p>
  </div>

  <div class="form-card">
    <form method="POST" action="<?php echo e(route('update-guru', $user)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <label for="name">Nama Guru *</label>
        <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required />
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

      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required />
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

      <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" />
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

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        <a href="<?php echo e(route('data-guru')); ?>" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-guru.blade.php ENDPATH**/ ?>