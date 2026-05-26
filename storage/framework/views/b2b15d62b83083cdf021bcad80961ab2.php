

<?php $__env->startSection('title', 'Notifikasi Saya - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
  <div class="notification-page">
    <div class="notification-page-header">
      <div>
        <h1 class="notification-card-title">Notifikasi Saya</h1>
        <p class="paragraph-muted">Menampilkan notifikasi terbaru untuk akun Anda.</p>
      </div>

      <div class="notification-page-actions">
        <?php if($unreadCount > 0): ?>
          <form method="POST" action="<?php echo e(route('notifications.read-all')); ?>" class="form-inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="button button-success button-tight">Tandai Semua Dibaca</button>
          </form>
        <?php endif; ?>
      </div>
    </div>

    <?php if($notifications->isEmpty()): ?>
      <div class="alert-box info">
        Tidak ada notifikasi untuk ditampilkan.
      </div>
    <?php else: ?>
      <div class="dashboard-grid">
        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="notification-card <?php echo e($notification->read_at ? 'read' : 'unread'); ?>">
            <div class="notification-card-header">
              <div>
                <h2 class="notification-card-title"><?php echo e($notification->title); ?></h2>
                <p class="notification-card-meta"><?php echo e($notification->created_at->format('d M Y H:i')); ?> <?php if(! $notification->read_at): ?> · Baru <?php endif; ?></p>
              </div>
              <?php if(! $notification->read_at): ?>
                <form method="POST" action="<?php echo e(route('notifications.read', $notification)); ?>" class="form-inline">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="button button-tight">Tandai Dibaca</button>
                </form>
              <?php endif; ?>
            </div>
            <?php if($notification->body): ?>
              <p class="notification-card-body"><?php echo e($notification->body); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\notifications.blade.php ENDPATH**/ ?>