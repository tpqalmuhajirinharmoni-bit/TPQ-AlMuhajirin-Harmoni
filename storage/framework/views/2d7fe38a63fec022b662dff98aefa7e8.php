

<?php $__env->startSection('title', 'Hubungi Kami - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
`r`n<div class="contact-container">
  <div class="contact-hero">
    <h2>Hubungi Kami</h2>
    <p>Kami siap membantu Anda. Jangan ragu untuk menghubungi kami dengan pertanyaan atau masukan apapun.</p>
    <?php if(auth()->guard()->check()): ?>
      <?php if(auth()->user()->hasRole('admin')): ?>
        <a href="<?php echo e(route('edit-contact-us')); ?>" class="button secondary mt-1 inline-block">Kelola Pesan Kontak</a>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php if(session('success')): ?>
    <div class="alert success">
      ✅ Pesan Anda telah terkirim! Tim kami akan merespons secepatnya.
    </div>
  <?php endif; ?>

  <div class="contact-grid">
    <div class="contact-form-wrapper">
      <h3>📧 Kirim Pesan</h3>
      
      <form method="POST" action="<?php echo e(route('contact.send')); ?>">
        <?php echo csrf_field(); ?>
        
        <div class="form-group required">
          <label>Nama Lengkap</label>
          <input type="text" name="name" placeholder="Nama Anda" required value="<?php echo e(old('name', auth()->user()->name ?? '')); ?>" />
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="error-small"><?php echo e($message); ?></small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group required">
          <label>Email</label>
          <input type="email" name="email" placeholder="Email Anda" required value="<?php echo e(old('email', auth()->user()->email ?? '')); ?>" />
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="error-small"><?php echo e($message); ?></small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group required">
          <label>Nomor Telepon</label>
          <input type="tel" name="phone" placeholder="081234567890" required value="<?php echo e(old('phone')); ?>" />
          <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="error-small"><?php echo e($message); ?></small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group required">
          <label>Subjek</label>
          <select name="subject" required>
            <option value="">Pilih Subjek</option>
            <option value="pendaftaran" <?php echo e(old('subject') == 'pendaftaran' ? 'selected' : ''); ?>>Pertanyaan Pendaftaran</option>
            <option value="biaya" <?php echo e(old('subject') == 'biaya' ? 'selected' : ''); ?>>Pertanyaan Biaya</option>
            <option value="teknis" <?php echo e(old('subject') == 'teknis' ? 'selected' : ''); ?>>Masalah Teknis</option>
            <option value="feedback" <?php echo e(old('subject') == 'feedback' ? 'selected' : ''); ?>>Umpan Balik</option>
            <option value="lainnya" <?php echo e(old('subject') == 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
          </select>
          <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="error-small"><?php echo e($message); ?></small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group required">
          <label>Pesan</label>
          <textarea name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
          <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="error-small"><?php echo e($message); ?></small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="submit-btn">Kirim Pesan</button>
      </form>
    </div>

    <div class="contact-info">
      <div class="info-card">
        <div class="info-icon">📍</div>
        <div class="info-content">
          <h4>Alamat</h4>
          <p>Jl. Harmoni Islami No. 45<br>Kelurahan Madina<br>Jakarta Timur, Indonesia</p>
        </div>
      </div>

      <div class="info-card">
        <div class="info-icon">📞</div>
        <div class="info-content">
          <h4>Telepon</h4>
          <p>
            <a href="tel:+621234567890">(021) 1234-5678</a><br>
            <a href="tel:+6287654321">+62 876-5432-1</a>
          </p>
        </div>
      </div>

      <div class="info-card">
        <div class="info-icon">📧</div>
        <div class="info-content">
          <h4>Email</h4>
          <p>
            <a href="mailto:info@tpqalmuhajirin.id">info@tpqalmuhajirin.id</a><br>
            <a href="mailto:pendaftaran@tpqalmuhajirin.id">pendaftaran@tpqalmuhajirin.id</a>
          </p>
        </div>
      </div>

      <div class="info-card">
        <div class="info-icon">🕒</div>
        <div class="info-content">
          <h4>Jam Operasional</h4>
          <p>
            <strong>Senin - Jumat:</strong><br>
            14:00 - 17:00<br>
            <strong>Sabtu - Minggu:</strong><br>
            08:00 - 12:00
          </p>
        </div>
      </div>

      <div class="info-card">
        <div class="info-icon">🔗</div>
        <div class="info-content">
          <h4>Ikuti Kami</h4>
          <div class="social-links">
            <a href="#" class="social-link" title="Facebook">f</a>
            <a href="#" class="social-link" title="Instagram">📷</a>
            <a href="#" class="social-link" title="WhatsApp">💬</a>
            <a href="#" class="social-link" title="YouTube">▶️</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="map-container">
    <h3>📍 Lokasi Kami</h3>
    <div class="map-placeholder">
      <p>Google Maps akan ditampilkan di sini</p>
      <p class="text-small">Jl. Harmoni Islami No. 45, Kelurahan Madina, Jakarta Timur</p>
    </div>
  </div>

  <div class="faq-section">
    <h3>❓ Pertanyaan yang Sering Diajukan</h3>
    
    <div class="faq-item">
      <strong>Bagaimana cara mendaftar santri baru?</strong>
      <p>Anda dapat melakukan pendaftaran santri baru melalui menu "Pendaftaran" di platform ini atau datang langsung ke kantor TPQ kami. Tim kami siap membantu proses pendaftaran Anda.</p>
    </div>

    <div class="faq-item">
      <strong>Berapa biaya pendaftaran dan SPP bulanan?</strong>
      <p>Biaya pendaftaran dan SPP dapat berbeda tergantung program dan kelas yang dipilih. Silakan hubungi kami untuk informasi lebih detail mengenai biaya pendaftaran dan SPP bulanan.</p>
    </div>

    <div class="faq-item">
      <strong>Apakah ada beasiswa untuk santri?</strong>
      <p>Ya, kami menyediakan program beasiswa untuk santri yang berprestasi dan santri yang memiliki keterbatasan ekonomi. Silakan hubungi bagian pendaftaran untuk informasi lebih lanjut.</p>
    </div>

    <div class="faq-item">
      <strong>Bagaimana cara melihat progress santri?</strong>
      <p>Orang tua dapat memantau progress santri melalui platform digital kami. Anda dapat melihat catatan kehadiran, perkembangan hafalan, dan laporan bulanan santri.</p>
    </div>

    <div class="faq-item">
      <strong>Kapan jadwal masuk santri baru?</strong>
      <p>Santri baru dapat dimulai sesuai dengan jadwal yang telah ditentukan. Biasanya penerimaan santri baru dilakukan sepanjang tahun dengan mekanisme yang fleksibel.</p>
    </div>

    <div class="faq-item">
      <strong>Bagaimana jika saya mengalami kesulitan teknis?</strong>
      <p>Jika Anda mengalami kesulitan teknis, silakan hubungi tim support kami melalui email atau telepon. Tim kami siap membantu mengatasi masalah yang Anda hadapi.</p>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\contact-us.blade.php ENDPATH**/ ?>