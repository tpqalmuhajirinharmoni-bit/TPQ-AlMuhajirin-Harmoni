<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('title', 'TPQ Al Muhajirin Harmoni'); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="<?php echo e(route('home')); ?>" class="brand-logo" aria-label="TPQ Al Muhajirin Harmoni Logo">
        <?php if(file_exists(public_path('uploads/logo.png'))): ?>
          <img src="<?php echo e(asset('uploads/logo.png')); ?>" alt="TPQ Al Muhajirin Harmoni" class="brand-mark" />
        <?php else: ?>
          <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="TPQ Al Muhajirin Harmoni" class="brand-mark" />
        <?php endif; ?>
      </a>
      <div class="brand-copy">
        <h1>TPQ Al Muhajirin Harmoni</h1>
        <p>Belajar Al-Qur'an dengan semangat harmoni islami</p>
      </div>
    </div>

    <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-label="Buka menu" aria-expanded="false" type="button">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="main-nav">
      <div class="nav-links">
        <a href="<?php echo e(route('home')); ?>">Beranda</a>
        <a href="<?php echo e(route('blog')); ?>">Berita</a>
        <a href="<?php echo e(route('ebook')); ?>">Ebook</a>
        <div class="nav-dropdown">
          <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
            Tentang TPQ
            <i class="fas fa-caret-down"></i>
          </button>
          <div class="dropdown-menu">
            <a href="<?php echo e(route('tpq.profile')); ?>">Profil TPQ</a>
            <?php if(auth()->guard()->check()): ?>
              <a href="<?php echo e(route('organization')); ?>">Struktur Organisasi</a>
            <?php endif; ?>
            <a href="<?php echo e(route('documentation')); ?>">Dokumentasi</a>
          </div>
        </div>
        <?php if(auth()->guard()->check()): ?>
          <div class="nav-dropdown">
            <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
              Aplikasi
              <i class="fas fa-caret-down"></i>
            </button>
            <div class="dropdown-menu">
              <a href="<?php echo e(route('finance')); ?>">Keuangan</a>
              <a href="<?php echo e(route('teachers')); ?>">Guru</a>
              <?php if (! (auth()->user()->hasRole('wali-santri'))): ?>
                <a href="<?php echo e(route('santri')); ?>">Santri</a>
                <a href="<?php echo e(route('evaluation')); ?>">Evaluasi</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        <a href="<?php echo e(route('contact')); ?>">Hubungi Kami</a>
      </div>

      <div class="nav-actions">
        <?php if(auth()->guard()->check()): ?>
          <?php
            $isRealAdmin = auth()->user()->roles()->where('slug', 'admin')->exists();
            $notificationCount = \Illuminate\Support\Facades\Schema::hasTable('notifications') ? auth()->user()->unreadNotifications()->count() : 0;
            $recentNotifications = \Illuminate\Support\Facades\Schema::hasTable('notifications') ? auth()->user()->notifications()->limit(10)->get() : collect();
          ?>

          <div class="notification-dropdown">
            <button class="notification-toggle button secondary" type="button" aria-haspopup="true" aria-expanded="false" aria-label="Notifikasi">
              <i class="fas fa-bell"></i>
              <?php if($notificationCount > 0): ?>
                <span class="notification-badge"><?php echo e($notificationCount); ?></span>
              <?php endif; ?>
            </button>
            <div class="notification-menu">
              <div class="notification-menu-header">
                <span>Notifikasi Terbaru</span>
                <span class="notification-menu-count"><?php echo e($recentNotifications->count()); ?>/10</span>
              </div>
              <div class="notification-items">
                <?php $__empty_1 = true; $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <a href="<?php echo e(route('notifications')); ?>" class="notification-item<?php echo e($notification->read_at ? '' : ' unread'); ?>">
                    <div class="notification-item-title"><?php echo e(Str::limit($notification->title, 60)); ?></div>
                    <div class="notification-item-meta"><?php echo e($notification->created_at->format('d M Y H:i')); ?> <?php if(! $notification->read_at): ?> · Baru <?php endif; ?></div>
                  </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <div class="notification-empty">Tidak ada notifikasi terbaru.</div>
                <?php endif; ?>
              </div>
              <a href="<?php echo e(route('notifications')); ?>" class="button view-all-notifications">Lihat notifikasi selengkapnya</a>
            </div>
          </div>

          <div class="profile-dropdown">
            <button class="profile-toggle" type="button">
              <i class="fas fa-user-circle"></i>
              <span>Hai..! <?php echo e(auth()->user()->name); ?></span>
              <i class="fas fa-caret-down"></i>
            </button>
            <div class="profile-menu">
              <div class="dropdown-user-card">
                <div class="dropdown-avatar"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></div>
                <div>
                  <div class="dropdown-user-name"><?php echo e(auth()->user()->name); ?></div>
                  <div class="dropdown-user-email"><?php echo e(auth()->user()->email); ?></div>
                </div>
              </div>
              <a href="<?php echo e(route('profile')); ?>">Lihat Profil</a>
              <a href="<?php echo e(auth()->user()->hasRole('admin') ? route('admin') : route('dashboard')); ?>">Dashboard</a>
              <a href="<?php echo e(route('forum')); ?>">Forum</a>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="button">Keluar</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <button id="open-login" class="button secondary">Login</button>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <main class="page-content">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 TPQ Al Muhajirin Harmoni | Harmoni dalam Iman dan Ilmu</p>
  </footer>

  <script src="<?php echo e(asset('js/main.js')); ?>"></script>
  <?php echo $__env->make('auth.modal-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\layouts\app.blade.php ENDPATH**/ ?>