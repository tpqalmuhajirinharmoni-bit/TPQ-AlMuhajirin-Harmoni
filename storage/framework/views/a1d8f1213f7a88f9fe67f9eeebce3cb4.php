<div id="login-modal" class="modal" aria-hidden="true" aria-modal="true" role="dialog" aria-labelledby="login-modal-title" tabindex="-1">
  <div class="modal-overlay" data-action="close"></div>
  <div class="modal-panel" role="document">
    <button class="modal-close" data-action="close" aria-label="Tutup">&times;</button>
    <div class="modal-content">
      <h3 id="login-modal-title" class="modal-title">Silahkan Login.</h3>
      <p class="modal-subtitle">Masukkan email atau username dan kata sandi Anda untuk mengakses akun.</p>

      <?php if($errors->has('login')): ?>
        <div class="modal-error">
          <strong>Gagal masuk:</strong> <?php echo e($errors->first('login')); ?>

          <div class="modal-error-suggestion">Saran: Periksa kembali Email/Username dan Password, cek Caps Lock, atau gunakan <a href="/password/reset">Lupa Password</a>.</div>
        </div>
      <?php elseif($errors->any()): ?>
        <div class="modal-error">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('login.post')); ?>" class="modal-form">
        <?php echo csrf_field(); ?>

        <label class="modal-label">
          Email atau Username
          <input type="text" name="username" value="<?php echo e(old('username')); ?>" placeholder="Email atau Username" required autofocus />
        </label>

        <label class="modal-label">
          Kata Sandi
          <input type="password" name="password" placeholder="Kata sandi" required />
        </label>

        <label class="modal-remember">
          <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> /> Ingat saya
        </label>

        <div class="modal-actions">
          <button type="submit" class="button button-primary">Masuk</button>
          <a href="<?php echo e(route('register')); ?>" class="button button-ghost">Daftar</a>
          <button type="button" class="button secondary" data-action="close">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\auth\modal-login.blade.php ENDPATH**/ ?>