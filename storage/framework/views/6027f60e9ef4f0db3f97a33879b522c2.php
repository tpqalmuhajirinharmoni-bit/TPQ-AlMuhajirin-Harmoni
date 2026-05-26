

<?php $__env->startSection('title', 'Kalender Akademik - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Kalender Akademik</h1>
      <p>Semua jadwal kegiatan dan pembelajaran TPQ dalam satu tampilan.</p>
    </div>
    <div class="top-actions">
      <button id="open-create-schedule-modal" class="btn-primary" type="button">+ Tambah Jadwal</button>
      <a href="<?php echo e(route('admin')); ?>" class="btn-primary">← Kembali ke Dashboard</a>
    </div>
  </div>

  <div id="create-schedule-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-create-schedule-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Tambah Jadwal Akademik</h2>
      <form method="POST" action="<?php echo e(route('admin.schedule.store')); ?>" class="form-grid">
        <?php echo csrf_field(); ?>
        <div class="form-columns">
          <input type="text" name="day" placeholder="Hari" required class="form-control">
          <input type="text" name="time" placeholder="Waktu" required class="form-control">
        </div>
        <div class="form-columns">
          <input type="text" name="group" placeholder="Kelas / Grup" class="form-control">
          <input type="text" name="activity" placeholder="Aktivitas" required class="form-control">
        </div>
        <div class="form-row">
          <button type="button" id="cancel-create-schedule-modal" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="<?php echo e(route('data-calendar')); ?>" class="filter-bar">
    <input type="text" name="q" placeholder="Cari hari, grup, atau aktivitas..." value="<?php echo e(request('q')); ?>" class="form-control">
    <button type="submit">Cari</button>
  </form>

  <div class="table-container">
    <?php if($schedules->count() > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Waktu</th>
            <th>Grup / Kelas</th>
            <th>Aktivitas</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($schedule->day); ?></td>
              <td><?php echo e($schedule->time); ?></td>
              <td><?php echo e($schedule->group ?? 'Umum'); ?></td>
              <td><?php echo e($schedule->activity); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="empty-state">Belum ada jadwal akademik yang disimpan.</div>
    <?php endif; ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-schedule-modal');
    const closeModal = document.getElementById('close-create-schedule-modal');
    const cancelModal = document.getElementById('cancel-create-schedule-modal');
    const modal = document.getElementById('create-schedule-modal');

    if (openModal) {
      openModal.addEventListener('click', function () {
        modal.style.display = 'flex';
      });
    }
    if (closeModal) {
      closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }
    if (cancelModal) {
      cancelModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }
    if (modal) {
      modal.addEventListener('click', function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-calendar.blade.php ENDPATH**/ ?>