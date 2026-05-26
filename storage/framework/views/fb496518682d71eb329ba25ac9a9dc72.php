

<?php $__env->startSection('title', 'Kelola Kontak - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <h1>Kelola Pesan Kontak</h1>
    <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Admin</a>
  </div>

  <?php if(session('success')): ?>
    <div class="success-message"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <div class="card-section">
    <h2>Tambah Pesan Kontak</h2>
    <form action="<?php echo e(route('store-contact-message')); ?>" method="POST" class="contact-form">
      <?php echo csrf_field(); ?>
      <div class="form-row">
        <label>Nama</label>
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required />
      </div>
      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required />
      </div>
      <div class="form-row">
        <label>Telepon</label>
        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" />
      </div>
      <div class="form-row">
        <label>Subjek</label>
        <input type="text" name="subject" value="<?php echo e(old('subject')); ?>" required />
      </div>
      <div class="form-row">
        <label>Pesan</label>
        <textarea name="message" rows="4" required><?php echo e(old('message')); ?></textarea>
      </div>
      <button type="submit" class="btn-primary">Tambahkan Pesan</button>
    </form>
  </div>

  <div class="table-container">
    <?php if($messages->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Subjek</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($message->name); ?></td>
              <td><?php echo e($message->email); ?></td>
              <td><?php echo e($message->phone ?? '-'); ?></td>
              <td><?php echo e($message->subject); ?></td>
              <td class="message-text"><?php echo e($message->message); ?></td>
              <td><?php echo e($message->created_at->format('d M Y, H:i')); ?></td>
              <td>
                <div class="action-buttons">
                  <a href="<?php echo e(route('edit-contact-message', $message)); ?>" class="btn-edit">Edit</a>
                  <form action="<?php echo e(route('delete-contact-message', $message)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="empty-state">Belum ada pesan kontak.</div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-contact.blade.php ENDPATH**/ ?>