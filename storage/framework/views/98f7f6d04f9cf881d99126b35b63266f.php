

<?php $__env->startSection('title', 'Edit Data Santri'); ?>

<?php $__env->startSection('content'); ?>

<div class="form-page">
  <div class="form-header">
    <h1>Edit Data Santri</h1>
    <p>Perbarui informasi santri</p>
  </div>

  <div class="form-card">
    <form method="POST" action="<?php echo e(route('update-santri', $user)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <label for="name">Nama Lengkap *</label>
        <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required />
        <?php $__errorArgs = ['name'];
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
        <label for="nickname">Nama Panggilan *</label>
        <input type="text" id="nickname" name="nickname" value="<?php echo e(old('nickname', $user->nickname)); ?>" required />
        <?php $__errorArgs = ['nickname'];
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
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo e(old('username', $user->username)); ?>" readonly />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" />
        <?php $__errorArgs = ['email'];
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
        <label for="birth_place">Tempat Lahir *</label>
        <input type="text" id="birth_place" name="birth_place" value="<?php echo e(old('birth_place', $user->birth_place)); ?>" required />
        <?php $__errorArgs = ['birth_place'];
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
        <label for="birth_date">Tanggal Lahir *</label>
        <input type="date" id="birth_date" name="birth_date" value="<?php echo e(old('birth_date', $user->birth_date)); ?>" required />
        <?php $__errorArgs = ['birth_date'];
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
        <label for="age">Umur</label>
        <input type="text" id="age" name="age" value="<?php echo e(old('age', $user->age)); ?>" readonly />
      </div>

      <div class="form-group">
        <label for="guardian_id">Wali Santri *</label>
        <select id="guardian_id" name="guardian_id" required>
          <option value="">Pilih Wali Santri</option>
          <?php $__currentLoopData = $guardians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guardian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($guardian->id); ?>" data-address="<?php echo e($guardian->address); ?>" <?php echo e(old('guardian_id', $user->guardian_id) == $guardian->id ? 'selected' : ''); ?>><?php echo e($guardian->name); ?> (<?php echo e($guardian->username); ?>)</option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['guardian_id'];
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
        <label for="address">Alamat Santri</label>
        <textarea id="address" name="address" rows="3" readonly><?php echo e(old('address', $user->address)); ?></textarea>
      </div>

      <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" />
        <?php $__errorArgs = ['phone'];
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

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        <a href="<?php echo e(route('data-santri')); ?>" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const birthDateInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');
    const guardianSelect = document.getElementById('guardian_id');
    const addressTextarea = document.getElementById('address');

    const updateAge = () => {
      if (!birthDateInput || !ageInput) return;
      const birthDate = birthDateInput.value;
      if (!birthDate) {
        ageInput.value = '';
        return;
      }
      const birthday = new Date(birthDate);
      const today = new Date();
      let years = today.getFullYear() - birthday.getFullYear();
      const monthDiff = today.getMonth() - birthday.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
        years -= 1;
      }
      ageInput.value = years >= 0 ? years : '';
    };

    const updateAddress = () => {
      if (!guardianSelect || !addressTextarea) return;
      const selected = guardianSelect.options[guardianSelect.selectedIndex];
      addressTextarea.value = selected ? selected.dataset.address || '' : '';
    };

    if (birthDateInput) {
      birthDateInput.addEventListener('change', updateAge);
      updateAge();
    }
    if (guardianSelect) {
      guardianSelect.addEventListener('change', updateAddress);
      updateAddress();
    }
  });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-santri.blade.php ENDPATH**/ ?>