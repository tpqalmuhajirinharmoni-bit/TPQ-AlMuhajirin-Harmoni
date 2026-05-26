

<?php $__env->startSection('title', 'Organisasi - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Struktur Organisasi</h2>
  <p>Data pengurus, pembina, dan struktur organisasi TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Struktur Organisasi</h3>
  <p>TPQ Al Muhajirin Harmoni dikelola oleh tim yang berkomitmen untuk meningkatkan kualitas pendidikan Al-Qur'an dan karakter santri.</p>
  <div class="stats-grid" style="margin-top:1.5rem; gap:1rem;">
    <article class="stats-card">
      <span class="stats-label">Total Staf TPQ</span>
      <strong><?php echo e(number_format($stats['staff'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Guru</span>
      <strong><?php echo e(number_format($stats['teachers'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Santri</span>
      <strong><?php echo e(number_format($stats['students'])); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Wali Santri</span>
      <strong><?php echo e(number_format($stats['guardians'])); ?></strong>
    </article>
  </div>

  <table style="margin-top:1.5rem;">
    <thead>
      <tr>
        <th>Peran</th>
        <th>Jumlah Tersedia</th>
        <th>Contoh Pengguna</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($role->name); ?></td>
          <td><?php echo e($role->users_count); ?></td>
          <td>
            <?php if($role->users->isNotEmpty()): ?>
              <?php echo e($role->users->pluck('name')->take(3)->join(', ')); ?><?php if($role->users->count() > 3): ?>, ...<?php endif; ?>
            <?php else: ?>
              Belum diisi
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>

<div class="overview-grid" style="margin-top: 2rem;">
  <div class="card-form">
    <h3>Visi Pengurus</h3>
    <p>Mengembangkan TPQ menjadi lembaga yang profesional, inklusif, dan berwawasan kebangsaan.</p>
  </div>
  <div class="card-form">
    <h3>Misi Pengurus</h3>
    <ul>
      <li>Menyediakan pembelajaran Al-Qur'an yang terstruktur.</li>
      <li>Meningkatkan kualitas guru dan pembimbing.</li>
      <li>Menjaga transparansi operasional dan keuangan.</li>
    </ul>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Tim Pendidikan</h3>
  <p>Tim pendidikan bertanggung jawab atas kurikulum, pengembangan guru, dan metode pengajaran yang sesuai kebutuhan santri.</p>
  <ul>
    <li>Koordinator Guru Putra & Putri</li>
    <li>Tim Kurikulum Al-Qur'an</li>
    <li>Tim Evaluasi dan Pembinaan Santri</li>
  </ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\organization.blade.php ENDPATH**/ ?>