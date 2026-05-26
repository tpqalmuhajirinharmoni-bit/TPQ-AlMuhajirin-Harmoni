

<?php $__env->startSection('title', 'Edit Pesan Kontak - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="data-page">
  <div class="page-header">
    <h1>Edit Pesan Kontak</h1>
    <a href="<?php echo e(route('edit-contact-us')); ?>" class="btn-primary">← Kembali ke Kelola Kontak</a>
  </div>

  <?php if(session('success')): ?>
    <div class="success-message"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <div class="form-card">
    <form action="<?php echo e(route('update-contact-message', $contactMessage)); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-row">
        <label>Nama</label>
        <input type="text" name="name" value="<?php echo e(old('name', $contactMessage->name)); ?>" required />
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo e(old('email', $contactMessage->email)); ?>" required />
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-row">
        <label>Telepon</label>
        <input type="text" name="phone" value="<?php echo e(old('phone', $contactMessage->phone)); ?>" />
        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-row">
        <label>Subjek</label>
        <input type="text" name="subject" value="<?php echo e(old('subject', $contactMessage->subject)); ?>" required />
        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-row">
        <label>Pesan</label>
        <textarea name="message" rows="5" required><?php echo e(old('message', $contactMessage->message)); ?></textarea>
        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-contact-message.blade.php ENDPATH**/ ?>