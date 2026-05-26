

<?php $__env->startSection('title', 'Profil TPQ - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $settings = $tpqSettings ?? [];
    $heroSubtitle = $settings['tpq_hero_subtitle'] ?? 'Pusat pembelajaran Al-Qur\'an terpadu yang membentuk generasi Qur\'ani dengan akhlak mulia dalam naungan harmoni islami.';
    $aboutText = $settings['tpq_description'] ?? 'TPQ Al Muhajirin Harmoni adalah lembaga pendidikan Al-Qur\'an yang didirikan dengan visi untuk membentuk generasi yang qur\'ani, berakhlak mulia, dan memiliki semangat harmoni islami yang kuat. Kami berkomitmen memberikan pendidikan berkualitas dengan metode pembelajaran yang terstruktur dan bimbingan personal untuk setiap santri.';
    $heroFeatures = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $settings['tpq_features'] ?? '')));
    $vision = $settings['tpq_vision'] ?? 'Menjadi pusat pembelajaran Al-Qur\'an terdepan yang menghasilkan generasi Qur\'ani dengan akhlak mulia, wawasan luas, dan semangat harmoni islami dalam mengabdi kepada agama dan bangsa.';
    $missionItems = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $settings['tpq_mission'] ?? "Menyelenggarakan pendidikan Al-Qur'an yang profesional dan terstruktur\nMembimbing santri dalam pengembangan akhlak, keterampilan, dan pengetahuan islami\nMemberikan dukungan penuh kepada santri dan keluarga dalam perjalanan pembelajaran\nMembangun komunitas pembelajar yang solid dan saling mendukung\nMengintegrasikan teknologi modern dengan metode pembelajaran tradisional yang terbukti efektif")));
    $programItems = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $settings['tpq_programs'] ?? "Program Tahfidz Al-Qur'an\nProgram Tajwid dan Qira'at\nProgram Pendidikan Akhlak dan Keislaman\nProgram Kepemimpinan dan Pembinaan Karakter\nProgram Ekstrakurikuler dan Olahraga")));
    $highlightItems = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $settings['tpq_highlights'] ?? "Metode pembelajaran yang teruji dan terstruktur\nGuru berpengalaman dan bersertifikat\nFasilitas lengkap dan suasana belajar yang kondusif\nProgram digital platform untuk monitoring progress santri\nKomunikasi transparan dengan orang tua/wali\nKegiatan rohani dan pembinaan karakter rutin")));
    $teamLines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $settings['tpq_team_members'] ?? "KH. Muhammad Syafii, Lc | Pendiri & Ketua Yayasan\nDrs. Abdul Hakim | Direktur TPQ\nUst. Siti Nurhaliza | Koordinator Guru Putri\nUst. Ridho Pratama | Koordinator Guru Putra")));
    $teamMembers = array_map(function ($line) {
        $parts = array_map('trim', explode('|', $line, 2));
        return [
            'name' => $parts[0] ?? $line,
            'role' => $parts[1] ?? '',
        ];
    }, $teamLines);
    $contactHours = $settings['tpq_hours'] ?? "Senin - Jumat: 14:00 - 17:00\nSabtu - Minggu: 08:00 - 12:00";
    $yearsText = $settings['tpq_years'] ?? '15+';
?>
<div class="tpq-container">
  <div class="tpq-hero">
    <span class="eyebrow">Tentang TPQ</span>
    <h2>TPQ Al Muhajirin Harmoni</h2>
    <p><?php echo e($heroSubtitle); ?></p>
    <div class="tpq-hero-features">
      <?php $__empty_1 = true; $__currentLoopData = $heroFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="hero-feature"><?php echo e($feature); ?></div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="hero-feature">Pembelajaran Al-Qur'an yang terstruktur</div>
        <div class="hero-feature">Pembinaan karakter dan akhlak</div>
        <div class="hero-feature">Kegiatan komunitas dan keluarga</div>
      <?php endif; ?>
    </div>

    <div class="hero-actions">
      <a href="#kontak" class="button primary">Hubungi Kami</a>
      <a href="#visi-misi" class="button secondary">Lihat Visi & Misi</a>
    </div>

    <div class="tpq-stats-row">
      <div class="tpq-stat-card">
        <strong><?php echo e($santriCount ?? 320); ?></strong>
        <span>Santri aktif</span>
      </div>
      <div class="tpq-stat-card">
        <strong><?php echo e($guruCount ?? 28); ?></strong>
        <span>Pengajar berpengalaman</span>
      </div>
      <div class="tpq-stat-card">
        <strong><?php echo e($classroomCount ?? 12); ?></strong>
        <span>Kelas terstruktur</span>
      </div>
      <div class="tpq-stat-card">
        <strong><?php echo e($yearsText); ?></strong>
        <span>Tahun Berdiri</span>
      </div>
    </div>
  </div>

  <div class="tpq-content">
    <div class="tpq-main">
      <div class="info-box info-box-primary">
        <h4>Tentang Kami</h4>
        <p><?php echo e($aboutText); ?></p>
      </div>

      <div class="section-block">
        <h3 id="visi-misi" class="section-title">Visi & Misi</h3>

        <div class="info-box info-box-success">
          <h4>Visi</h4>
          <p><?php echo e($vision); ?></p>
        </div>

        <div class="info-box info-box-warning">
          <h4>Misi</h4>
          <ul class="info-list">
            <?php $__currentLoopData = $missionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($mission); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>

      <div class="section-block">
        <h3 class="section-title">Program Pembelajaran</h3>

        <div class="tpq-card program-card">
          <h4>Program Utama</h4>
          <ul class="info-list">
            <?php $__currentLoopData = $programItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($program); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>

      <div class="section-block">
        <h3 class="section-title">Fasilitas & Kegiatan</h3>

        <div class="tpq-feature-grid">
          <?php if(count($heroFeatures) > 0): ?>
            <?php $__currentLoopData = $heroFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="tpq-feature-card"><?php echo e($feature); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="tpq-feature-card">Ruang kelas nyaman dan bersih</div>
            <div class="tpq-feature-card">Kegiatan rutin doa dan pembinaan akhlak</div>
            <div class="tpq-feature-card">Pendampingan orang tua dan wali</div>
            <div class="tpq-feature-card">Perpustakaan & bahan bacaan Islami</div>
            <div class="tpq-feature-card">Kegiatan ekstrakurikuler kreatif</div>
            <div class="tpq-feature-card">Monitoring perkembangan santri</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <aside class="tpq-sidebar">
      <div class="tpq-card">
        <h3>Statistik TPQ</h3>

        <div class="stats-grid">
          <div class="stat-item">
            <strong><?php echo e($santriCount ?? 0); ?></strong>
            <small>Santri Terdaftar</small>
          </div>
          <div class="stat-item">
            <strong><?php echo e($guruCount ?? 0); ?></strong>
            <small>Guru/Pembimbing</small>
          </div>
          <div class="stat-item">
            <strong><?php echo e($classroomCount ?? 0); ?></strong>
            <small>Kelas Aktif</small>
          </div>
          <div class="stat-item">
            <strong><?php echo e($yearsText); ?></strong>
            <small>Tahun Berdiri</small>
          </div>
        </div>
      </div>

      <div class="tpq-card contact-card" id="kontak">
        <h4>Kontak TPQ</h4>

        <div class="contact-item">
          <div class="contact-icon">📍</div>
          <div class="contact-details">
            <strong>Alamat</strong>
            <span><?php echo e($settings['tpq_address'] ?? 'Jl. Harmoni Islami No. 45, Kelurahan Madina, Jakarta Timur'); ?></span>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">📞</div>
          <div class="contact-details">
            <strong>Telepon</strong>
            <span><?php echo e($settings['tpq_phone'] ?? '(021) 1234-5678'); ?></span>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">📧</div>
          <div class="contact-details">
            <strong>Email</strong>
            <span><?php echo e($settings['tpq_email'] ?? 'info@tpqalmuhajirin.id'); ?></span>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon">🕒</div>
          <div class="contact-details">
            <strong>Jam Operasional</strong>
            <span><?php echo nl2br(e($contactHours)); ?></span>
          </div>
        </div>
      </div>
    </aside>
  </div>

  <div class="section-block">
    <h3 class="section-title">Tim Pengurus & Guru</h3>
    <div class="team-grid">
      <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="team-member">
          <div class="team-avatar"><?php echo e(strtoupper(substr($member['name'], 0, 2))); ?></div>
          <h4><?php echo e($member['name']); ?></h4>
          <p><?php echo e($member['role']); ?></p>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  <div class="info-box info-box-accent highlight-section">
    <h4>Keunggulan TPQ Al Muhajirin Harmoni</h4>
    <ul class="info-list">
      <?php $__currentLoopData = $highlightItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($highlight); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\tpq-profile.blade.php ENDPATH**/ ?>