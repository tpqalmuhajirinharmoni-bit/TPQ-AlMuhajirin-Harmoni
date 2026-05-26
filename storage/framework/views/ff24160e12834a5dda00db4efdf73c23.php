

<?php $__env->startSection('title', 'Profil User - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<div class="profile-container">
  <?php if(session('success')): ?>
    <div class="alert-box success">
      <?php echo e(session('success')); ?>

    </div>
  <?php endif; ?>

  <div class="profile-header">
    <div class="profile-avatar">
      <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

    </div>
    <div class="profile-heading">
      <h2>Profil TPQ</h2>
      <p class="profile-owner"><?php echo e(auth()->user()->name); ?></p>
      <p class="profile-email"><?php echo e(auth()->user()->email); ?></p>
      <p class="profile-intro">Halaman profil kamu menampilkan informasi akun, peran, dan akses TPQ.</p>
      <?php if(auth()->user()->hasRole('admin')): ?>
        <span class="role-badge">👑 Administrator</span>
      <?php elseif(auth()->user()->hasRole('guru')): ?>
        <span class="role-badge">👨‍🏫 Guru</span>
      <?php elseif(auth()->user()->hasRole('santri')): ?>
        <span class="role-badge">📖 Santri</span>
      <?php elseif(auth()->user()->hasRole('wali-santri')): ?>
        <span class="role-badge">👨‍👩‍👧 Wali Santri</span>
      <?php endif; ?>
    </div>
  </div>

  <?php
    $mainRole = auth()->user()->roles->first();
    $displayRole = $mainRole ? ucfirst(str_replace('_', ' ', $mainRole->slug)) : 'Pengguna';
    $accessSummary = auth()->user()->hasRole('admin') ? 'Akses penuh ke sistem TPQ' : (auth()->user()->hasRole('guru') ? 'Akses pengajar dan materi' : (auth()->user()->hasRole('santri') ? 'Akses santri ke materi & forum' : (auth()->user()->hasRole('wali-santri') ? 'Akses wali untuk memantau santri' : 'Akses standar')));
    $profileType = auth()->user()->hasRole('admin') ? 'Administrator TPQ' : (auth()->user()->hasRole('guru') ? 'Staf Pengajar' : (auth()->user()->hasRole('santri') ? 'Santri TPQ' : (auth()->user()->hasRole('wali-santri') ? 'Wali Santri' : 'Pengguna')));
  ?>

  <div class="profile-summary">
    <div class="profile-summary-card">
      <h3>Ringkasan TPQ</h3>
      <div class="summary-grid">
        <div class="summary-item">
          <span>Peran Utama</span>
          <strong><?php echo e($displayRole); ?></strong>
        </div>
        <div class="summary-item">
          <span>Akses TPQ</span>
          <strong><?php echo e($accessSummary); ?></strong>
        </div>
        <div class="summary-item">
          <span>Tipe Profil</span>
          <strong><?php echo e($profileType); ?></strong>
        </div>
      </div>
      <p class="summary-note">Gunakan menu atas untuk membuka materi TPQ, forum diskusi, notifikasi, dan fitur profil yang tersedia.</p>
    </div>
  </div>

  <div class="profile-quick-actions">
    <a href="<?php echo e(route('forum')); ?>" class="quick-action-card">
      <div class="quick-action-icon"><i class="fas fa-comments"></i></div>
      <div class="quick-action-body">
        <strong>Forum TPQ</strong>
        <p>Diskusikan pelajaran dan kegiatan TPQ secara cepat.</p>
      </div>
    </a>
    <a href="<?php echo e(route('notifications')); ?>" class="quick-action-card">
      <div class="quick-action-icon"><i class="fas fa-bell"></i></div>
      <div class="quick-action-body">
        <strong>Notifikasi</strong>
        <p>Cek pesan penting, pengumuman, dan kegiatan terbaru.</p>
      </div>
    </a>
    <a href="<?php echo e(route('home')); ?>" class="quick-action-card">
      <div class="quick-action-icon"><i class="fas fa-home"></i></div>
      <div class="quick-action-body">
        <strong>Dashboard</strong>
        <p>Kembali ke halaman utama TPQ dengan cepat.</p>
      </div>
    </a>
  </div>

  <div class="profile-content">
    <div class="profile-card">
      <h3>Informasi Akun</h3>
      
      <div class="info-group">
        <label>Nama Lengkap</label>
        <p><?php echo e(auth()->user()->name); ?></p>
      </div>

      <div class="info-group">
        <label>Username</label>
        <p><?php echo e(auth()->user()->username); ?></p>
      </div>

      <div class="info-group">
        <label>Email</label>
        <p><?php echo e(auth()->user()->email); ?></p>
      </div>

      <div class="info-group">
        <label>Status Akun</label>
        <p><span class="status-pill">Aktif</span></p>
      </div>

      <div class="info-group">
        <label>Bergabung Sejak</label>
        <p><?php echo e(auth()->user()->created_at->format('d F Y')); ?></p>
      </div>
    </div>

    <div class="profile-card">
      <h3>Statistik</h3>
      
      <div class="stats-grid">
        <div class="stat-item">
          <strong><?php echo e(auth()->user()->roles->count()); ?></strong>
          <small>Role</small>
        </div>
        <div class="stat-item">
          <strong><?php echo e(auth()->user()->created_at->diffInDays()); ?></strong>
          <small>Hari Aktif</small>
        </div>
      </div>

      <h4 class="section-subtitle">Role & Akses</h4>
      <div class="info-group">
        <label>Peran Saat Ini</label>
        <p class="role-list">
          <?php $__currentLoopData = auth()->user()->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="role-badge"><?php echo e(ucfirst(str_replace('_', ' ', $role->slug))); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
      </div>
    </div>
  </div>

  <div class="edit-section">
    <h4>Perbarui Data Pribadi</h4>
    
    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" required />
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" required />
      </div>

      <div class="form-group">
        <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
        <input type="password" name="password" placeholder="Masukkan password baru" />
      </div>

      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" />
      </div>

      <div class="button-group">
        <a href="<?php echo e(route('home')); ?>" class="button secondary">Batal</a>
        <button type="submit" class="button">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\profile.blade.php ENDPATH**/ ?>