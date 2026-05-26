

<?php $__env->startSection('title', 'Login - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Silahkan Login.</h2>
  
  <?php if($errors->has('login')): ?>
    <div class="error-message-box">
      <strong>Gagal masuk: </strong> <?php echo e($errors->first('login')); ?>

      <div class="error-message-hint">
        Saran: Periksa kembali Email/Username dan Password Anda, pastikan Caps Lock mati, atau gunakan fitur <a href="/password/reset">Lupa Password</a> jika diperlukan.
      </div>
    </div>
  <?php elseif($errors->any()): ?>
    <div class="error-message-box">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?php echo e(route('login.post')); ?>" class="card-form">
    <?php echo csrf_field(); ?>

    <label>
      Email atau Username
      <input 
        type="text" 
        name="username" 
        value="<?php echo e(old('username')); ?>"
        placeholder="Email atau Username" 
        required 
        autofocus
      />
    </label>

    <label>
      Kata Sandi
      <input 
        type="password" 
        name="password" 
        placeholder="Kata sandi" 
        required 
      />
    </label>

    <p class="form-note">
      Silahkan login menggunakan Email/Username dan Password.
    </p>

    <label class="checkbox-label">
      <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> />
      <span>Ingat saya</span>
    </label>

    <div class="form-actions">
      <button type="submit" class="button">Masuk</button>
      <a href="<?php echo e(route('home')); ?>" class="button secondary">Batal</a>
    </div>
  </form>

  <p class="form-note">
    Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar sekarang</a>.
  </p>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\auth\login.blade.php ENDPATH**/ ?>