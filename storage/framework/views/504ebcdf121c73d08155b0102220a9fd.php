

<?php $__env->startSection('title', 'Edit Profil TPQ - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="edit-page">
  <div class="page-header">
    <h1>Edit Profil TPQ</h1>
  </div>

  <div class="form-container">
    <div class="note-box">
      Data profil TPQ disimpan permanen di database. Gunakan form di bawah untuk memperbarui informasi umum TPQ.
    </div>

    <form method="POST" action="<?php echo e(route('update-tpq-profile')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <label for="tpq_name">Nama TPQ</label>
        <input type="text" id="tpq_name" name="tpq_name" value="<?php echo e(old('tpq_name', $tpqSettings['tpq_name'] ?? '')); ?>" required>
        <?php $__errorArgs = ['tpq_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_hero_subtitle">Subjudul Hero</label>
        <input type="text" id="tpq_hero_subtitle" name="tpq_hero_subtitle" value="<?php echo e(old('tpq_hero_subtitle', $tpqSettings['tpq_hero_subtitle'] ?? '')); ?>" placeholder="Contoh: Pusat pembelajaran Al-Qur'an terpadu yang ...">
        <?php $__errorArgs = ['tpq_hero_subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_description">Deskripsi Halaman Tentang TPQ</label>
        <textarea id="tpq_description" name="tpq_description"><?php echo e(old('tpq_description', $tpqSettings['tpq_description'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_features">Fitur Utama (satu per baris)</label>
        <textarea id="tpq_features" name="tpq_features" placeholder="Pembelajaran Al-Qur'an yang terstruktur\nPembinaan karakter dan akhlak\nKegiatan komunitas dan keluarga"><?php echo e(old('tpq_features', $tpqSettings['tpq_features'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_features'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_vision">Visi</label>
        <textarea id="tpq_vision" name="tpq_vision"><?php echo e(old('tpq_vision', $tpqSettings['tpq_vision'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_mission">Misi (satu per baris)</label>
        <textarea id="tpq_mission" name="tpq_mission" placeholder="Menyelenggarakan pendidikan Al-Qur'an yang profesional dan terstruktur\nMembimbing santri dalam pengembangan akhlak..."><?php echo e(old('tpq_mission', $tpqSettings['tpq_mission'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_programs">Program Pembelajaran (satu per baris)</label>
        <textarea id="tpq_programs" name="tpq_programs" placeholder="Program Tahfidz Al-Qur'an\nProgram Tajwid dan Qira'at\nProgram Pendidikan Akhlak dan Keislaman"><?php echo e(old('tpq_programs', $tpqSettings['tpq_programs'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_programs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_highlights">Keunggulan / Highlight (satu per baris)</label>
        <textarea id="tpq_highlights" name="tpq_highlights" placeholder="Metode pembelajaran yang teruji dan terstruktur\nGuru berpengalaman dan bersertifikat\nFasilitas lengkap dan suasana belajar yang kondusif"><?php echo e(old('tpq_highlights', $tpqSettings['tpq_highlights'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_highlights'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_team_members">Tim Pengurus & Guru (format: Nama | Jabatan, satu per baris)</label>
        <textarea id="tpq_team_members" name="tpq_team_members" placeholder="KH. Muhammad Syafii, Lc | Pendiri & Ketua Yayasan\nDrs. Abdul Hakim | Direktur TPQ"><?php echo e(old('tpq_team_members', $tpqSettings['tpq_team_members'] ?? '')); ?></textarea>
        <?php $__errorArgs = ['tpq_team_members'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_years">Tahun Berdiri / Pengalaman</label>
        <input type="text" id="tpq_years" name="tpq_years" value="<?php echo e(old('tpq_years', $tpqSettings['tpq_years'] ?? '15+')); ?>" placeholder="Contoh: 15+ tahun">
        <?php $__errorArgs = ['tpq_years'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_hours">Jam Operasional</label>
        <input type="text" id="tpq_hours" name="tpq_hours" value="<?php echo e(old('tpq_hours', $tpqSettings['tpq_hours'] ?? 'Senin - Jumat: 14:00 - 17:00\nSabtu - Minggu: 08:00 - 12:00')); ?>" placeholder="Senin - Jumat: 14:00 - 17:00\nSabtu - Minggu: 08:00 - 12:00">
        <?php $__errorArgs = ['tpq_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_address">Alamat TPQ</label>
        <input type="text" id="tpq_address" name="tpq_address" value="<?php echo e(old('tpq_address', $tpqSettings['tpq_address'] ?? '')); ?>">
        <?php $__errorArgs = ['tpq_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_phone">Telepon TPQ</label>
        <input type="text" id="tpq_phone" name="tpq_phone" value="<?php echo e(old('tpq_phone', $tpqSettings['tpq_phone'] ?? '')); ?>">
        <?php $__errorArgs = ['tpq_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="tpq_email">Email TPQ</label>
        <input type="email" id="tpq_email" name="tpq_email" value="<?php echo e(old('tpq_email', $tpqSettings['tpq_email'] ?? '')); ?>">
        <?php $__errorArgs = ['tpq_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="logo">Logo Situs (opsional)</label>
        <?php if(!empty($tpqSettings['tpq_logo'])): ?>
          <div class="current-logo"><img src="<?php echo e(asset('storage/' . $tpqSettings['tpq_logo'])); ?>" alt="Logo" class="logo-preview" /></div>
        <?php endif; ?>
        <input type="file" id="logo" name="logo" accept="image/*" />
        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Profil</button>
        <a href="<?php echo e(route('admin')); ?>" class="btn-cancel">Kembali</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin-edit-tpq-profile.blade.php ENDPATH**/ ?>