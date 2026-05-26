

<?php $__env->startSection('title', 'Data Keuangan - Admin'); ?>

<?php $__env->startSection('content'); ?>
  <div class="data-page">
    <div class="page-header">
      <div>
        <h2>Data Keuangan</h2>
        <p class="page-note">Kelola transaksi pemasukan dan pengeluaran.</p>
      </div>
      <div class="top-actions">
        <button id="open-create-transaction-modal" class="button primary" type="button">+ Tambah Transaksi</button>
        <a href="<?php echo e(route('admin')); ?>" class="button secondary">← Kembali ke Dashboard</a>
      </div>
    </div>

    <div id="create-transaction-modal" class="modal-overlay">
      <div class="modal-card sm">
        <button id="close-create-transaction-modal" type="button" class="modal-close">&times;</button>
        <h3 class="modal-title">Tambah Transaksi Baru</h3>
        <form method="POST" action="<?php echo e(route('admin.finance.store')); ?>" class="form-grid">
          <?php echo csrf_field(); ?>
          <div class="form-columns">
            <select name="type" required class="form-control">
              <option value="income">Pemasukan</option>
              <option value="expense">Pengeluaran</option>
            </select>
            <input type="number" name="amount" placeholder="Jumlah (Rp)" required class="form-control">
          </div>
          <input type="text" name="category" placeholder="Kategori" class="form-control">
          <textarea name="description" rows="3" placeholder="Deskripsi transaksi" class="form-control"></textarea>
          <input type="date" name="transaction_date" value="<?php echo e(date('Y-m-d')); ?>" required class="form-control">
          <div class="form-row">
            <button type="button" id="cancel-create-transaction-modal" class="button secondary cancel">Batal</button>
            <button type="submit" class="button primary">Simpan Transaksi</button>
          </div>
        </form>
      </div>
    </div>

    <form method="GET" action="<?php echo e(route('data-keuangan')); ?>" class="filter-bar">
      <input type="search" name="q" placeholder="Cari kategori, deskripsi, atau tanggal..." value="<?php echo e(request('q')); ?>" class="form-control">
      <button type="submit" class="button primary">Cari</button>
    </form>

    <div class="summary-card">
      <p class="summary-title">Ringkasan Keuangan</p>
      <p>Total Pemasukan: <strong>Rp <?php echo e(number_format($totalIncome ?? 0,0,',','.')); ?></strong></p>
      <p>Total Pengeluaran: <strong>Rp <?php echo e(number_format($totalExpense ?? 0,0,',','.')); ?></strong></p>
      <p>Saldo: <strong>Rp <?php echo e(number_format(($totalIncome ?? 0) - ($totalExpense ?? 0),0,',','.')); ?></strong></p>
    </div>
    <div class="table-container">
      <?php if($transactions->isEmpty()): ?>
        <div class="empty-state">Belum ada transaksi.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>Tipe</th>
              <th>Jumlah</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th>Tanggal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(ucfirst($t->type)); ?></td>
                <td>Rp <?php echo e(number_format($t->amount ?? 0,0,',','.')); ?></td>
                <td><?php echo e($t->category); ?></td>
                <td><?php echo e(Str::limit($t->description, 60)); ?></td>
                <td><?php echo e($t->transaction_date); ?></td>
                <td><a href="<?php echo e(route('edit-keuangan', $t)); ?>">Edit</a></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-transaction-modal');
    const closeModal = document.getElementById('close-create-transaction-modal');
    const cancelModal = document.getElementById('cancel-create-transaction-modal');
    const modal = document.getElementById('create-transaction-modal');

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-keuangan.blade.php ENDPATH**/ ?>