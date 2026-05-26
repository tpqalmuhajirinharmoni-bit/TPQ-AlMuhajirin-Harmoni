

<?php $__env->startSection('title', 'Data Peralatan - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <h1>Data Peralatan</h1>
    <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Admin</a>
  </div>

  <?php if(session('success')): ?>
    <div class="success-message"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <div class="table-container">
    <?php if($equipments->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peralatan</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Tanggal Beli</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($item->name); ?></td>
              <td><?php echo e($item->category); ?></td>
              <td><?php echo e($item->quantity); ?></td>
              <td>
                <?php if($item->condition === 'baik'): ?>
                  <span class="badge-status badge-good">Baik</span>
                <?php elseif($item->condition === 'rusak ringan'): ?>
                  <span class="badge-status badge-damaged">Rusak Ringan</span>
                <?php else: ?>
                  <span class="badge-status badge-damaged">Rusak Berat</span>
                <?php endif; ?>
              </td>
              <td><?php echo e($item->purchase_date ? $item->purchase_date->format('d M Y') : '-'); ?></td>
              <td>
                <div class="action-buttons">
                  <a href="<?php echo e(route('edit-peralatan', $item)); ?>" class="btn-edit">Edit</a>
                  <form action="<?php echo e(route('delete-peralatan', $item)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data peralatan ini?');">
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
      <div class="empty-state">Belum ada data peralatan.</div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-peralatan.blade.php ENDPATH**/ ?>