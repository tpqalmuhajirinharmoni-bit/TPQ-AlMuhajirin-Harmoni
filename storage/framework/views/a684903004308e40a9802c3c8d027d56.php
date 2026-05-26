

<?php $__env->startSection('title', 'Daftar Akun - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Daftar Akun Baru</h2>

  <?php if($errors->any()): ?>
    <div class="error-message-box">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?php echo e(route('register.post')); ?>" class="card-form">
    <?php echo csrf_field(); ?>

    <label>
      Nama Lengkap
      <input
        type="text"
        name="name"
        value="<?php echo e(old('name')); ?>"
        placeholder="Nama lengkap"
        required
        autofocus
      />
    </label>

    <label>
      Nama Pengguna
      <input
        type="text"
        name="username"
        value="<?php echo e(old('username')); ?>"
        placeholder="contoh: nurul"
        required
      />
    </label>

    <label>
      Email
      <input
        type="email"
        name="email"
        value="<?php echo e(old('email')); ?>"
        placeholder="email@contoh.com"
        required
      />
    </label>

    <label>
      Hak Akses
      <select name="role" required>
        <option value="">Pilih hak akses...</option>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($role->slug); ?>" <?php echo e(old('role') === $role->slug ? 'selected' : ''); ?>>
            <?php echo e($role->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </label>

    <label>
      Kata Sandi
      <input
        type="password"
        name="password"
        placeholder="Minimal 8 karakter"
        required
      />
    </label>

    <label>
      Konfirmasi Kata Sandi
      <input
        type="password"
        name="password_confirmation"
        placeholder="Ulangi kata sandi"
        required
      />
    </label>

    <div>
      <button type="submit" class="button">Daftar</button>
      <a href="<?php echo e(route('login')); ?>" class="button secondary">Sudah punya akun?</a>
    </div>
  </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\auth\register.blade.php ENDPATH**/ ?>