

<?php $__env->startSection('title', 'Data Santri - Admin'); ?>

<?php $__env->startSection('content'); ?>
  <div class="data-page">
    <div class="page-header">
      <div>
        <h2>Data Santri</h2>
        <p class="page-note">Kelola santri dan cari data dengan cepat.</p>
      </div>
      <div class="top-actions">
        <button id="open-create-santri-modal" class="button primary" type="button">+ Tambah Santri</button>
        <a href="<?php echo e(route('admin')); ?>" class="button secondary">← Kembali ke Dashboard</a>
      </div>
    </div>

    <div id="create-santri-modal" class="modal-overlay">
      <div class="modal-card sm">
        <button id="close-create-santri-modal" type="button" class="modal-close">&times;</button>
        <h3 class="modal-title">Tambah Santri Baru</h3>
        <form method="POST" action="<?php echo e(route('admin.santri.store')); ?>" class="form-grid">
          <?php echo csrf_field(); ?>
          <div class="form-columns">
            <input type="text" name="name" id="name" placeholder="Nama Lengkap Santri" required class="form-control">
            <input type="text" name="nickname" id="nickname" placeholder="Nama Panggilan Santri" required class="form-control">
          </div>
          <div class="form-columns">
            <input type="text" name="username" id="username" placeholder="Username otomatis" readonly class="form-control readonly">
            <input type="email" name="email" id="email" placeholder="Email Santri (opsional)" class="form-control">
          </div>
          <div class="form-columns">
            <input type="text" name="birth_place" id="birth_place" placeholder="Tempat Lahir" required class="form-control">
            <input type="date" name="birth_date" id="birth_date" required class="form-control">
          </div>
          <div class="form-columns">
            <input type="text" name="age" id="age" placeholder="Umur otomatis" readonly class="form-control readonly">
            <select name="guardian_id" id="guardian_id" required class="form-control">
              <option value="">Pilih Wali Santri</option>
              <?php $__currentLoopData = $guardians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guardian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($guardian->id); ?>" data-address="<?php echo e($guardian->address); ?>"><?php echo e($guardian->name); ?> (<?php echo e($guardian->username); ?>)</option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div>
            <textarea id="address" rows="3" readonly placeholder="Alamat otomatis dari data wali santri" class="form-control readonly"></textarea>
            <input type="hidden" name="address" id="hidden_address">
          </div>
          <div class="form-row">
            <button type="button" id="cancel-create-santri-modal" class="button secondary cancel">Batal</button>
            <button type="submit" class="button primary">Simpan Santri</button>
          </div>
        </form>
      </div>
    </div>

    <form method="GET" action="<?php echo e(route('data-santri')); ?>" class="filter-bar">
      <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="<?php echo e(request('q')); ?>" class="form-control">
      <button type="submit" class="button primary">Cari</button>
    </form>

    <div class="table-container">
      <?php if($santri->isEmpty()): ?>
        <div class="empty-state">Belum ada data santri.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Dibuat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $santri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($s->name); ?></td>
                <td><?php echo e($s->username); ?></td>
                <td><?php echo e($s->email); ?></td>
                <td><?php echo e($s->created_at->format('d M Y')); ?></td>
                <td><a href="<?php echo e(route('edit-santri', $s)); ?>">Edit</a></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-santri-modal');
    const closeModal = document.getElementById('close-create-santri-modal');
    const cancelModal = document.getElementById('cancel-create-santri-modal');
    const modal = document.getElementById('create-santri-modal');
    const nicknameInput = document.getElementById('nickname');
    const usernameInput = document.getElementById('username');
    const birthDateInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');
    const guardianSelect = document.getElementById('guardian_id');
    const addressTextarea = document.getElementById('address');
    const hiddenAddressInput = document.getElementById('hidden_address');

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

    const formatUsername = (value) => {
      return value.trim().toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g, '');
    };

    const updateUsername = () => {
      if (nicknameInput && usernameInput) {
        usernameInput.value = formatUsername(nicknameInput.value || '');
      }
    };

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

    const updateGuardianAddress = () => {
      if (!guardianSelect || !addressTextarea || !hiddenAddressInput) return;
      const selected = guardianSelect.options[guardianSelect.selectedIndex];
      const address = selected ? selected.dataset.address || '' : '';
      addressTextarea.value = address;
      hiddenAddressInput.value = address;
    };

    if (nicknameInput) {
      nicknameInput.addEventListener('input', updateUsername);
      updateUsername();
    }
    if (birthDateInput) {
      birthDateInput.addEventListener('change', updateAge);
      updateAge();
    }
    if (guardianSelect) {
      guardianSelect.addEventListener('change', updateGuardianAddress);
      updateGuardianAddress();
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-data-santri.blade.php ENDPATH**/ ?>