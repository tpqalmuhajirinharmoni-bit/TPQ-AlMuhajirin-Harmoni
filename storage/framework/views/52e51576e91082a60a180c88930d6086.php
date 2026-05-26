

<?php $__env->startSection('title', 'Pendaftaran Santri - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Pendaftaran Santri Baru</h2>
  <p>Daftar menjadi santri di TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 600px; margin: 2rem auto;">
  <form>
    <label>
      Nama Lengkap
      <input type="text" placeholder="Nama santri" required />
    </label>
    <label>
      Tempat, Tanggal Lahir
      <input type="text" placeholder="Tempat, DD/MM/YYYY" required />
    </label>
    <label>
      Nama Orang Tua
      <input type="text" placeholder="Orang tua/wali" required />
    </label>
    <label>
      Nomor Telepon
      <input type="tel" placeholder="+62..." required />
    </label>
    <label>
      Alamat
      <textarea placeholder="Alamat lengkap" rows="3" required></textarea>
    </label>
    <div>
      <button type="submit" class="button">Daftar</button>
      <a href="<?php echo e(route('home')); ?>" class="button secondary">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\new-santri.blade.php ENDPATH**/ ?>