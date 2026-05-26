

<?php $__env->startSection('title', 'Edit Peralatan - Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="edit-page">
  <div class="page-header">
    <h1>Edit Peralatan</h1>
  </div>

  <div class="form-container">
    <form method="POST" action="<?php echo e(route('update-peralatan', $equipment)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <label for="name">Nama Peralatan</label>
        <input type="text" id="name" name="name" value="<?php echo e(old('name', $equipment->name)); ?>" required>
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="category">Kategori</label>
        <input type="text" id="category" name="category" value="<?php echo e(old('category', $equipment->category)); ?>" required>
        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="quantity">Jumlah</label>
        <input type="number" id="quantity" name="quantity" min="0" value="<?php echo e(old('quantity', $equipment->quantity)); ?>" required>
        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="condition">Kondisi</label>
        <select id="condition" name="condition" required>
          <option value="">Pilih Kondisi</option>
          <option value="baik" <?php echo e(old('condition', $equipment->condition) === 'baik' ? 'selected' : ''); ?>>Baik</option>
          <option value="rusak ringan" <?php echo e(old('condition', $equipment->condition) === 'rusak ringan' ? 'selected' : ''); ?>>Rusak Ringan</option>
          <option value="rusak berat" <?php echo e(old('condition', $equipment->condition) === 'rusak berat' ? 'selected' : ''); ?>>Rusak Berat</option>
        </select>
        <?php $__errorArgs = ['condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="purchase_date">Tanggal Pembelian</label>
        <input type="date" id="purchase_date" name="purchase_date" value="<?php echo e(old('purchase_date', optional($equipment->purchase_date)->format('Y-m-d'))); ?>">
        <?php $__errorArgs = ['purchase_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea id="description" name="description"><?php echo e(old('description', $equipment->description)); ?></textarea>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="<?php echo e(route('data-peralatan')); ?>" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-peralatan.blade.php ENDPATH**/ ?>