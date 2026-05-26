

<?php $__env->startSection('title', 'Edit Keuangan - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="edit-page">
  <div class="page-header">
    <h1>Edit Transaksi Keuangan</h1>
  </div>

  <div class="form-container">
    <div class="form-info">
      <strong>ID Transaksi:</strong> #<?php echo e($transaction->id); ?>

    </div>

    <form method="POST" action="<?php echo e(route('update-keuangan', $transaction)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <label for="type">Tipe Transaksi</label>
        <select id="type" name="type" required>
          <option value="">Pilih Tipe</option>
          <option value="income" <?php echo e(old('type', $transaction->type) === 'income' ? 'selected' : ''); ?>>Pemasukan</option>
          <option value="expense" <?php echo e(old('type', $transaction->type) === 'expense' ? 'selected' : ''); ?>>Pengeluaran</option>
        </select>
        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="error-message"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="category">Kategori</label>
        <input type="text" id="category" name="category" value="<?php echo e(old('category', $transaction->category)); ?>" placeholder="Contoh: Sumbangan, Gaji Guru, dll" required>
        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="error-message"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="amount">Jumlah (Rp)</label>
        <input type="number" id="amount" name="amount" value="<?php echo e(old('amount', $transaction->amount)); ?>" min="1" placeholder="0" required>
        <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="error-message"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="transaction_date">Tanggal Transaksi</label>
        <input type="date" id="transaction_date" name="transaction_date" value="<?php echo e(old('transaction_date', $transaction->transaction_date->format('Y-m-d'))); ?>" required>
        <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="error-message"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea id="description" name="description" placeholder="Masukkan keterangan transaksi"><?php echo e(old('description', $transaction->description)); ?></textarea>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="error-message"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="<?php echo e(route('data-keuangan')); ?>" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-keuangan.blade.php ENDPATH**/ ?>