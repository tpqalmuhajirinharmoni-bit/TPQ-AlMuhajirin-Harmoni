

<?php $__env->startSection('title', 'Admin - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>

<div class="dashboard-header">
  <h2>Dashboard Administrator</h2>
  <p>Statistik TPQ Al Muhajirin Harmoni Tahun Anggaran 2026</p>
</div>

<?php if(session('success')): ?>
  <div class="success-message">
    <?php echo e(session('success')); ?>

  </div>
<?php endif; ?>

<div class="dashboard-layout">
  <?php echo $__env->make('components.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="dashboard-content">
    <section class="admin-panel active" id="overview">
      <div class="statistics-section">
        <h3 class="statistics-title">📊 Ringkasan</h3>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon">🏫</div>
            <div class="stat-number"><?php echo e($classroomCount); ?></div>
            <div class="stat-label">Kelas/Grup</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">👨‍🏫</div>
            <div class="stat-number"><?php echo e($guruCount); ?></div>
            <div class="stat-label">Guru/Pembimbing</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">📖</div>
            <div class="stat-number"><?php echo e($materialsCount); ?></div>
            <div class="stat-label">Data Ebook</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-number"><?php echo e($schedulesCount); ?></div>
            <div class="stat-label">Kalender Akademik</div>
          </div>
        </div>
        <div class="colored-stats-grid">
          <div class="colored-stat-card pink">
            <div class="stat-icon">👥</div>
            <div class="colored-stat-number"><?php echo e($totalUsers); ?></div>
            <div class="colored-stat-label">Total User</div>
          </div>
          <div class="colored-stat-card green">
            <div class="stat-icon">👨‍🎓</div>
            <div class="colored-stat-number"><?php echo e($santriCount); ?></div>
            <div class="colored-stat-label">Santri Terdaftar</div>
          </div>
          <div class="colored-stat-card blue">
            <div class="stat-icon">📋</div>
            <div class="colored-stat-number"><?php echo e($appointmentsCount); ?></div>
            <div class="colored-stat-label">Surat Izin</div>
          </div>
          <div class="colored-stat-card orange">
            <div class="stat-icon">📄</div>
            <div class="colored-stat-number"><?php echo e(count($posts ?? [])); ?></div>
            <div class="colored-stat-label">Postingan Blog</div>
          </div>
        </div>
        
        <div class="dashboard-grid dashboard-grid-spaced">
          <div class="dashboard-card">
            <h4>📰 Posting Terbaru</h4>
            <div class="activity-list">
              <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="activity-item">
                  <div>
                    <div class="activity-item-title"><?php echo e(Str::limit($p->title, 40)); ?></div>
                    <div class="activity-item-meta"><?php echo e($p->created_at->format('d M Y')); ?></div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">Belum ada posting</div>
              <?php endif; ?>
            </div>
          </div>

          <div class="dashboard-card">
            <h4>💰 Transaksi Terakhir</h4>
            <div class="activity-list">
              <?php $__empty_1 = true; $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="activity-item <?php echo e($t->type); ?>">
                  <div>
                    <div class="activity-item-type"><?php echo e(ucfirst($t->type)); ?></div>
                    <div class="activity-highlight">Rp <?php echo e(number_format($t->amount ?? 0, 0, ',', '.')); ?></div>
                    <div class="activity-item-meta"><?php echo e($t->transaction_date); ?></div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">Belum ada transaksi</div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="chart-panel" class="dashboard-card admin-panel">
      <h3>📊 Grafik & Analitik</h3>
      <div class="chart-placeholder">
        Grafik Statistik (Dashboard Analytics Coming Soon)
      </div>
    </section>

    <section id="message-panel" class="dashboard-card admin-panel">
      <h3>📩 Pesan Masuk</h3>
      <div class="activity-list">
        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="activity-item">
            <div>
              <div class="activity-item-title"><?php echo e(Str::limit($message->subject ?? 'Pesan baru', 50)); ?></div>
              <div class="activity-item-meta"><?php echo e($message->created_at->format('d M Y H:i')); ?></div>
              <div class="activity-description"><?php echo e(Str::limit($message->message, 90)); ?></div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="empty-state">Belum ada pesan masuk.</div>
        <?php endif; ?>
      </div>
      <div class="section-footer">
        <a href="<?php echo e(route('edit-contact-us')); ?>" class="button">Lihat Semua Pesan</a>
      </div>
    </section>

    <section id="settings-panel" class="dashboard-card admin-panel">
      <h3>⚙️ Pengaturan Website</h3>
      <div class="stacked-section">
        <div class="card-section">
          <h4>Halaman Tentang TPQ</h4>
          <p class="text-muted">Perbarui isi lengkap halaman Tentang TPQ, termasuk visi, misi, program, dan informasi kontak.</p>
          <div class="section-footer">
            <a href="<?php echo e(route('edit-tpq-profile')); ?>" class="button button-primary">Edit Halaman Tentang TPQ</a>
          </div>
        </div>

        <div class="card-section">
          <h4>Laporan Masalah</h4>
          <div class="activity-list spaced">
            <?php $__empty_1 = true; $__currentLoopData = $issueReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <div class="activity-item expense activity-card">
                <div>
                  <div class="activity-item-title"><?php echo e(Str::limit($report->subject ?? 'Laporan masalah', 50)); ?></div>
                  <div class="activity-item-meta"><?php echo e($report->created_at->format('d M Y H:i')); ?></div>
                  <div class="activity-description"><?php echo e(Str::limit($report->message, 90)); ?></div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <div class="empty-state">Belum ada laporan masalah yang spesifik.</div>
            <?php endif; ?>
          </div>
          <div class="section-footer">
            <a href="<?php echo e(route('edit-contact-us')); ?>" class="button">Kelola Laporan</a>
          </div>
        </div>
      </div>
    </section>

    <section id="notifications-panel" class="dashboard-card admin-panel">
      <h3>🔔 Notifikasi Terbaru</h3>
      <div class="activity-list">
        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="activity-item<?php echo e($notification->read_at ? '' : ' income'); ?>">
            <div>
              <div class="activity-item-title"><?php echo e(Str::limit($notification->title, 60)); ?></div>
              <div class="activity-item-meta"><?php echo e($notification->created_at->format('d M Y H:i')); ?> <?php if(!$notification->read_at): ?> · <strong>Baru</strong><?php endif; ?></div>
              <?php if($notification->body): ?>
                <div class="activity-description"><?php echo e(Str::limit($notification->body, 100)); ?></div>
              <?php endif; ?>
            </div>
            <div>
              <form method="POST" action="<?php echo e(route('notifications.read', $notification)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="button button-small button-primary">Tandai Dibaca</button>
              </form>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="empty-state">Tidak ada notifikasi baru.</div>
        <?php endif; ?>
      </div>
      <div class="action-row">
        <a href="<?php echo e(route('notifications')); ?>" class="button">Lihat Semua Notifikasi</a>
        <?php if($unreadNotificationCount > 0): ?>
          <form method="POST" action="<?php echo e(route('notifications.read-all')); ?>" class="inline-form">
            <?php echo csrf_field(); ?>
            <button type="submit" class="button button-success">Tandai Semua Dibaca</button>
          </form>
        <?php endif; ?>
      </div>
    </section>

    <section id="santri-form" class="dashboard-card admin-panel">
      <h3>⚙️ Input Data Santri</h3>
      <form method="POST" action="<?php echo e(route('admin.santri.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Nama Santri
          <input type="text" name="name" placeholder="Masukkan nama santri" required />
        </label>
        <label>
          Username
          <input type="text" name="username" placeholder="Username santri" required />
        </label>
        <label>
          Email
          <input type="email" name="email" placeholder="Email santri" required />
        </label>
        <button type="submit" class="button">Simpan Santri</button>
      </form>
    </section>

    <section id="attendance-teacher-panel" class="dashboard-card admin-panel">
      <h3>🗂️ Absensi Guru</h3>

      <div class="action-row">
        <form method="POST" action="<?php echo e(route('admin.attendance.store')); ?>" class="inline-form">
          <?php echo csrf_field(); ?>
          <label>
            Pilih Guru
            <select name="user_id">
              <option value="">-- Pilih Guru --</option>
              <?php $__currentLoopData = \App\Models\User::whereHas('roles', fn($q)=> $q->where('slug','guru'))->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($g->id); ?>"><?php echo e($g->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </label>
          <label>
            Tanggal
            <input type="date" name="date" value="<?php echo e(date('Y-m-d')); ?>" />
          </label>
          <label>
            Status
            <select name="status">
              <option value="present">Hadir</option>
              <option value="absent">Tidak Hadir</option>
              <option value="late">Telat</option>
              <option value="pending">Permintaan Izin</option>
            </select>
          </label>
          <label>
            Catatan koreksi
            <input type="text" name="note" placeholder="Catatan (opsional)" />
          </label>
          <button type="submit" class="button">Simpan Absensi</button>
        </form>
      </div>

      <div class="section-block">
        <div class="attendance-summary-grid">
          <div class="attendance-summary-card summary-pending">
            <div><?php echo e($pendingTeacherAttendances->count()); ?></div>
            <small>Permintaan Izin</small>
          </div>
          <div class="attendance-summary-card summary-total">
            <div><?php echo e($teacherAttendances->count()); ?></div>
            <small>Total Absensi</small>
          </div>
        </div>

        <?php if($pendingTeacherAttendances->isNotEmpty()): ?>
          <div class="attendance-pending-list">
            <h5>Permintaan Izin Guru</h5>
            <ul>
              <?php $__currentLoopData = $pendingTeacherAttendances->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <span><?php echo e($pending->user?->name ?? 'Guru'); ?> — <?php echo e($pending->date?->format('d M Y') ?? '-'); ?></span>
                  <div class="pending-actions">
                    <form method="POST" action="<?php echo e(route('admin.attendance.approve', $pending)); ?>" class="inline-form">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="button button-success">Terima</button>
                    </form>
                    <form method="POST" action="<?php echo e(route('admin.attendance.reject', $pending)); ?>" class="inline-form">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="button button-danger">Tolak</button>
                    </form>
                  </div>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="attendance-filter-row">
          <div>
            <h4>Daftar Absensi Terakhir</h4>
            <p class="text-muted">Filter berdasarkan status untuk menemukan permintaan izin dan koreksi dengan cepat.</p>
          </div>
          <div>
            <label class="filter-label">
              Status
              <select id="attendance-status-filter" class="modal-input">
                <option value="all">Semua Status</option>
                <option value="present">Hadir</option>
                <option value="absent">Tidak Hadir</option>
                <option value="late">Telat</option>
                <option value="pending">Menunggu Izin</option>
                <option value="permission">Izin Disetujui</option>
                <option value="rejected">Izin Ditolak</option>
              </select>
            </label>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Guru</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $teacherAttendances ?? \App\Models\Attendance::with('user')->latest()->limit(20)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="attendance-row status-<?php echo e($att->status); ?>" data-status="<?php echo e($att->status); ?>">
                  <td><?php echo e($att->date?->format('d M Y') ?? '-'); ?></td>
                  <td><?php echo e($att->user?->name ?? '—'); ?></td>
                  <td>
                    <?php
                      $statusLabels = [
                        'present' => 'Hadir',
                        'absent' => 'Tidak Hadir',
                        'late' => 'Telat',
                        'pending' => 'Menunggu Izin',
                        'permission' => 'Izin Disetujui',
                        'rejected' => 'Izin Ditolak',
                      ];
                    ?>
                    <span class="status-badge status-<?php echo e($att->status); ?>"><?php echo e($statusLabels[$att->status] ?? ucfirst($att->status)); ?></span>
                  </td>
                  <td><?php echo e($att->note ?? '—'); ?></td>
                  <td>
                          <button class="button button-small" data-action="open-correction" data-id="<?php echo e($att->id); ?>">Koreksi</button>
                    <?php if($att->status === 'pending'): ?>
                      <form method="POST" action="<?php echo e(route('admin.attendance.approve', $att)); ?>" class="inline-form">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="button button-success">Terima</button>
                      </form>
                      <form method="POST" action="<?php echo e(route('admin.attendance.reject', $att)); ?>" class="inline-form">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="button button-danger">Tolak</button>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>

      <div id="correction-modal" class="modal-overlay">
        <div class="modal-panel">
          <button class="modal-close">&times;</button>
          <h4>Koreksi Absensi</h4>
          <form id="correction-form" method="POST" action="#">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" name="attendance_id" id="corr-attendance-id" value="" />
            <div id="correction-error" class="error-message" style="display:none;"></div>
            <label>Tanggal <input type="date" name="date" id="corr-date" class="modal-input" /></label>
            <label>Status
              <select name="status" id="corr-status" class="modal-input">
                <option value="present">Hadir</option>
                <option value="absent">Tidak Hadir</option>
                <option value="late">Telat</option>
                <option value="pending">Menunggu Izin</option>
                <option value="permission">Izin Disetujui</option>
                <option value="rejected">Izin Ditolak</option>
              </select>
            </label>
            <label>Catatan <input type="text" name="note" id="corr-note" class="modal-input" /></label>
            <div class="button-group">
              <button type="button" class="btn-cancel" id="corr-cancel">Batal</button>
              <button type="submit" class="btn-submit">Simpan Koreksi</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <section id="attendance-student-panel" class="dashboard-card admin-panel">
      <h3>📋 Absensi Santri</h3>
      <div class="attendance-summary-grid">
        <div class="attendance-summary-card summary-total">
          <div><?php echo e($studentAttendanceTotal); ?></div>
          <small>Total Absensi Santri</small>
        </div>
        <div class="attendance-summary-card summary-success">
          <div><?php echo e($studentPresentCount); ?></div>
          <small>Hadir</small>
        </div>
        <div class="attendance-summary-card summary-pending">
          <div><?php echo e($studentAbsentCount); ?></div>
          <small>Absen</small>
        </div>
        <div class="attendance-summary-card summary-warning">
          <div><?php echo e($studentLateCount); ?></div>
          <small>Telat</small>
        </div>
        <div class="attendance-summary-card summary-info">
          <div><?php echo e($studentPermissionCount); ?></div>
          <small>Izin Disetujui</small>
        </div>
        <div class="attendance-summary-card summary-dark">
          <div><?php echo e($studentPendingCount); ?></div>
          <small>Menunggu Izin</small>
        </div>
      </div>
      <div class="section-block">
        <p class="text-muted">Absensi santri hari ini: <strong><?php echo e($studentAttendanceToday); ?></strong></p>
        <div class="section-footer">
          <a href="<?php echo e(route('data-santri')); ?>" class="button">Kelola Absensi Santri</a>
        </div>
      </div>
    </section>

    <section id="raport-panel" class="dashboard-card admin-panel">
      <h3>🧾 Raport Santri</h3>
      <div class="attendance-summary-grid">
        <div class="attendance-summary-card summary-total">
          <div>0</div>
          <small>Raport Tersedia</small>
        </div>
        <div class="attendance-summary-card summary-pending">
          <div>0</div>
          <small>Raport Draft</small>
        </div>
      </div>
      <p class="text-muted">Kelola hasil evaluasi dan cetak raport setiap semester di sini.</p>
      <div class="section-footer">
        <a href="<?php echo e(route('raport')); ?>" class="button">Lihat Halaman Raport</a>
      </div>
    </section>

    <section id="achievement-panel" class="dashboard-card admin-panel">
      <h3>🏆 Prestasi Santri</h3>
      <div class="attendance-summary-grid">
        <div class="attendance-summary-card summary-success">
          <div>0</div>
          <small>Prestasi Terverifikasi</small>
        </div>
        <div class="attendance-summary-card summary-pending">
          <div>0</div>
          <small>Pengajuan Baru</small>
        </div>
      </div>
      <p class="text-muted">Catat prestasi lomba, juara, dan penghargaan santri dalam satu tempat.</p>
      <div class="section-footer">
        <a href="<?php echo e(route('prestasi')); ?>" class="button">Lihat Halaman Prestasi</a>
      </div>
    </section>

    <section id="finance-form" class="dashboard-card admin-panel">
      <h3>💳 Input Data Pemasukan & Pengeluaran</h3>
      <form method="POST" action="<?php echo e(route('admin.finance.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Tipe Transaksi
          <select name="type" required>
            <option value="income">Pemasukan</option>
            <option value="expense">Pengeluaran</option>
          </select>
        </label>
        <label>
          Jumlah (Rp)
          <input type="number" name="amount" placeholder="0" required />
        </label>
        <label>
          Kategori
          <input type="text" name="category" placeholder="Contoh: Sumbangan" />
        </label>
        <label>
          Keterangan
          <textarea name="description" rows="3" placeholder="Deskripsi transaksi"></textarea>
        </label>
        <label>
          Tanggal
          <input type="date" name="transaction_date" value="<?php echo e(date('Y-m-d')); ?>" required />
        </label>
        <button type="submit" class="button">Catat Transaksi</button>
        <div class="action-row">
          <a href="<?php echo e(route('admin.finance.export.csv')); ?>" class="button button-info">Unduh CSV</a>
          <a href="<?php echo e(route('admin.finance.export.pdf')); ?>" class="button button-accent">Buka Laporan</a>
        </div>
      </form>
    </section>

    <section id="guru-form" class="dashboard-card admin-panel">
      <h3>👨‍🏫 Input Data Guru</h3>
      <form method="POST" action="<?php echo e(route('admin.guru.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Nama Guru
          <input type="text" name="name" placeholder="Masukkan nama guru" required />
        </label>
        <label>
          Username
          <input type="text" name="username" placeholder="Username guru (opsional)" />
        </label>
        <label>
          Email
          <input type="email" name="email" placeholder="Email guru (opsional)" />
        </label>
        <label>
          Mata Pelajaran
          <input type="text" name="specialty" placeholder="Contoh: Al-Qur'an" />
        </label>
        <label>
          Kontak
          <input type="text" name="contact" placeholder="Email / Telepon" />
        </label>
        <button type="submit" class="button">Simpan Guru</button>
      </form>
    </section>

    <section id="wali-form" class="dashboard-card admin-panel">
      <h3>👨‍👩‍👧 Input Wali Santri</h3>
      <form method="POST" action="<?php echo e(route('admin.wali.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Nama Wali
          <input type="text" name="name" placeholder="Masukkan nama wali santri" required />
        </label>
        <label>
          Username
          <input type="text" name="username" placeholder="Username wali (opsional)" />
        </label>
        <label>
          Email
          <input type="email" name="email" placeholder="Email wali" required />
        </label>
        <label>
          Telepon
          <input type="text" name="phone" placeholder="Nomor telepon wali" />
        </label>
        <button type="submit" class="button">Simpan Wali Santri</button>
      </form>
    </section>

    <section id="user-create-form" class="dashboard-card admin-panel">
      <h3>👥 Tambah User Baru</h3>
      <form method="POST" action="<?php echo e(route('admin.user.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Nama User
          <input type="text" name="name" placeholder="Masukkan nama user" required />
        </label>
        <label>
          Username
          <input type="text" name="username" placeholder="Username user (opsional)" />
        </label>
        <label>
          Email
          <input type="email" name="email" placeholder="Email user" required />
        </label>
        <label>
          Role
          <select name="role" required>
            <option value="">Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="wali-santri">Wali Santri</option>
            <option value="santri">Santri</option>
          </select>
        </label>
        <button type="submit" class="button">Buat User</button>
      </form>
    </section>

    <section id="materi-form" class="dashboard-card admin-panel">
      <h3>📖 Input Data Ebook</h3>
      <form method="POST" action="<?php echo e(route('admin.material.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Judul Materi
          <input type="text" name="title" placeholder="Judul materi" required />
        </label>
        <label>
          Kategori
          <input type="text" name="category" placeholder="Contoh: Tajwid" />
        </label>
        <label>
          Deskripsi Singkat
          <textarea name="description" rows="3" placeholder="Ringkas deskripsi materi"></textarea>
        </label>
        <button type="submit" class="button">Tambah Materi</button>
      </form>
    </section>

    <section id="schedule-form" class="dashboard-card admin-panel">
      <h3>📅 Input Kalender Akademik</h3>
      <form method="POST" action="<?php echo e(route('admin.schedule.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Hari
          <input type="text" name="day" placeholder="Senin" required />
        </label>
        <label>
          Waktu
          <input type="text" name="time" placeholder="08:00 - 10:00" required />
        </label>
        <label>
          Kelas / Grup
          <input type="text" name="group" placeholder="Grup Tahfidz" />
        </label>
        <label>
          Aktivitas
          <input type="text" name="activity" placeholder="Contoh: Hafalan Surah" required />
        </label>
        <button type="submit" class="button">Simpan Jadwal</button>
      </form>
    </section>

    <section id="announcement-form" class="dashboard-card admin-panel">
      <h3>📢 Buat Pengumuman</h3>
      <form method="POST" action="<?php echo e(route('admin.announcement.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Judul Pengumuman
          <input type="text" name="title" placeholder="Judul pengumuman" required />
        </label>
        <label>
          Isi Pengumuman
          <textarea name="content" rows="5" placeholder="Tulis informasi penting" required></textarea>
        </label>
        <button type="submit" class="button">Publikasikan</button>
      </form>
    </section>

    <section id="post-form" class="dashboard-card admin-panel">
      <h3>✍️ Buat Posting</h3>
      <form method="POST" action="<?php echo e(route('admin.post.store')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Judul Post
          <input type="text" name="title" placeholder="Judul artikel atau berita" required />
        </label>
        <label>
          Konten Singkat
          <textarea name="summary" rows="4" placeholder="Ringkasan posting"></textarea>
        </label>
        <label>
          Konten Lengkap
          <textarea name="content" rows="5" placeholder="Tulis isi posting" required></textarea>
        </label>
        <button type="submit" class="button">Terbitkan Post</button>
      </form>
    </section>

    <section id="edit-post-form" class="dashboard-card admin-panel">
      <h3>✏️ Update Posting Blog</h3>
      <form method="POST" action="<?php echo e(route('admin.post.update')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          Pilih Post
          <select name="post_id" required>
            <option value="">Pilih postingan...</option>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($post->id); ?>"><?php echo e($post->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </label>
        <label>
          Judul Baru
          <input type="text" name="title" placeholder="Judul baru" required />
        </label>
        <label>
          Ringkasan Baru
          <textarea name="summary" rows="3" placeholder="Ringkasan posting"></textarea>
        </label>
        <label>
          Konten Baru
          <textarea name="content" rows="5" placeholder="Konten posting" required></textarea>
        </label>
        <button type="submit" class="button">Perbarui Post</button>
      </form>
    </section>

    <section id="documentation-form" class="dashboard-card admin-panel">
      <h3>📚 Upload Dokumentasi</h3>
      <form method="POST" action="<?php echo e(route('admin.documentation.store')); ?>" class="card-form" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <label>
          Judul Dokumentasi
          <input type="text" name="title" placeholder="Judul dokumentasi" required />
        </label>
        <label>
          Keterangan
          <textarea name="description" rows="3" placeholder="Deskripsi singkat"></textarea>
        </label>
        <label>
          Tipe File
          <select name="type" required>
            <option value="image">Gambar</option>
            <option value="video">Video</option>
            <option value="ebook">Ebook / Dokumen</option>
          </select>
        </label>
        <label>
          Unggah File
          <input type="file" name="file" accept="image/*,video/*,.pdf,.epub,.doc,.docx,.txt" required />
        </label>
        <button type="submit" class="button">Upload Dokumentasi</button>
      </form>
    </section>

    <section id="user-form" class="dashboard-card admin-panel">
      <h3>👥 Edit Data User</h3>
      <form method="POST" action="<?php echo e(route('admin.user.update')); ?>" class="card-form">
        <?php echo csrf_field(); ?>
        <label>
          User ID
          <input type="number" name="user_id" placeholder="Masukkan ID user" required />
        </label>
        <label>
          Role Baru
          <select name="role" required>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="wali-santri">Wali Santri</option>
            <option value="santri">Santri</option>
          </select>
        </label>
        <label>
          Status Akun
          <select name="status" required>
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
          </select>
        </label>
        <button type="submit" class="button">Update User</button>
      </form>
    </section>

    <section id="edit-santri-form" class="dashboard-card admin-panel">
      <h3>👨‍🎓 Edit/Update Data Santri</h3>
      <p class="text-note">
        📌 Silahkan kunjungi halaman <a href="<?php echo e(route('data-santri')); ?>" class="link-highlight">Data Santri</a> untuk melakukan edit atau update data santri secara langsung.
      </p>
      <div class="info-box">
        <strong>💡 Fitur:</strong>
        <ul class="info-list">
          <li>Edit data personal santri</li>
          <li>Update informasi kontak</li>
          <li>Ubah status keanggotaan</li>
          <li>Hapus data santri jika diperlukan</li>
        </ul>
      </div>
    </section>

    <!-- Edit Guru Form -->
    <section id="edit-guru-form" class="dashboard-card admin-panel">
      <h3>👨‍🏫 Edit/Update Data Guru</h3>
      <p class="text-note">
        📌 Silahkan kunjungi halaman <a href="<?php echo e(route('data-guru')); ?>" class="link-highlight">Data Guru</a> untuk melakukan edit atau update data guru secara langsung.
      </p>
      <div class="info-box">
        <strong>💡 Fitur:</strong>
        <ul class="info-list">
          <li>Edit profil guru</li>
          <li>Update spesialisasi mengajar</li>
          <li>Ubah informasi kontak</li>
          <li>Kelola data kepegawaian</li>
        </ul>
      </div>
    </section>

    <!-- Edit Wali Santri Form -->
    <section id="edit-wali-form" class="dashboard-card admin-panel">
      <h3>👤 Edit/Update Data Wali Santri</h3>
      <p class="text-note">
        📌 Silahkan kunjungi halaman <a href="<?php echo e(route('data-wali-santri')); ?>" class="link-highlight">Data Wali Santri</a> untuk melakukan edit atau update data wali santri secara langsung.
      </p>
      <div class="info-box">
        <strong>💡 Fitur:</strong>
        <ul class="info-list">
          <li>Edit data orang tua/wali</li>
          <li>Update informasi kontak darurat</li>
          <li>Ubah data identitas</li>
          <li>Kelola hubungan dengan santri</li>
        </ul>
      </div>
    </section>

    <!-- Edit Keuangan Form -->
    <section id="edit-keuangan-form" class="dashboard-card admin-panel">
      <h3>💰 Edit/Update Data Keuangan</h3>
      <p class="text-note">
        📌 Silahkan kunjungi halaman <a href="<?php echo e(route('data-keuangan')); ?>" class="link-highlight">Data Keuangan</a> untuk melakukan edit atau update data transaksi secara langsung.
      </p>
      <div class="info-box">
        <strong>💡 Fitur:</strong>
        <ul class="info-list">
          <li>Edit transaksi pemasukan/pengeluaran</li>
          <li>Update kategori dan deskripsi</li>
          <li>Ubah nominal transaksi</li>
          <li>Kelola laporan keuangan berkala</li>
        </ul>
      </div>
    </section>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.admin-sidebar .nav-item[data-target]');
    const panels = document.querySelectorAll('.admin-panel');

    function showPanel(target) {
      panels.forEach(panel => panel.classList.toggle('active', panel.id === target));
      buttons.forEach(button => button.classList.toggle('active', button.dataset.target === target));
      const element = document.getElementById(target);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }

    buttons.forEach(button => {
      button.addEventListener('click', function () {
        showPanel(this.dataset.target);
      });
    });

    showPanel('overview');
  });
  
  // Modal handling for attendance correction
  (function () {
    function q(sel, ctx) { return (ctx || document).querySelector(sel); }
    function qa(sel, ctx) { return Array.from((ctx || document).querySelectorAll(sel)); }

    const modal = q('#correction-modal');
    const form = q('#correction-form');
    const closeBtn = q('#correction-modal .modal-close');
    const corrId = q('#corr-attendance-id');
    const corrDate = q('#corr-date');
    const corrStatus = q('#corr-status');
    const corrNote = q('#corr-note');
    const corrError = q('#correction-error');

    form.addEventListener('submit', function (event) {
      corrDate.classList.remove('invalid-input');
      corrStatus.classList.remove('invalid-input');
      corrError.style.display = 'none';
      corrError.textContent = '';

      if (!corrDate.value.trim()) {
        event.preventDefault();
        corrError.textContent = 'Tanggal koreksi wajib diisi sebelum menyimpan.';
        corrError.style.display = 'block';
        corrDate.classList.add('invalid-input');
        corrDate.focus();
        return;
      }

      if (!corrStatus.value.trim()) {
        event.preventDefault();
        corrError.textContent = 'Silakan pilih status absensi.';
        corrError.style.display = 'block';
        corrStatus.classList.add('invalid-input');
        corrStatus.focus();
      }
    });

    qa('button[data-action="open-correction"]').forEach(btn => {
      btn.addEventListener('click', function (e) {
        const id = this.dataset.id;
        corrId.value = id;
        form.action = '/admin/attendance/' + id;

        fetch('/admin/attendance/' + id, { credentials: 'same-origin' })
          .then(r => r.ok ? r.json() : Promise.reject(r))
          .then(data => {
            // fill ISO date if available
            if (data.date_iso) corrDate.value = data.date_iso.split(' ')[0];
            corrStatus.value = data.status || 'present';
            corrNote.value = data.note || '';
            modal.classList.add('active');
          })
          .catch(() => {
            // fallback: open empty for manual entry
            modal.classList.add('active');
          });
      });
    });

    const cancelBtn = q('#corr-cancel');

    function resetCorrectionForm() {
      corrError.style.display = 'none';
      corrError.textContent = '';
      corrDate.classList.remove('invalid-input');
      corrStatus.classList.remove('invalid-input');
      corrDate.value = '';
      corrStatus.value = 'present';
      corrNote.value = '';
      corrId.value = '';
      form.action = '#';
    }

    closeBtn?.addEventListener('click', function () {
      modal.classList.remove('active');
      resetCorrectionForm();
    });

    const attendanceFilter = q('#attendance-status-filter');
    const attendanceRows = qa('.attendance-row');

    function filterAttendanceRows(status) {
      attendanceRows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    attendanceFilter?.addEventListener('change', function () {
      filterAttendanceRows(this.value);
    });

    cancelBtn?.addEventListener('click', function () {
      modal.classList.remove('active');
      resetCorrectionForm();
    });

    window.addEventListener('click', function (e) {
      if (e.target === modal) {
        modal.classList.remove('active');
        resetCorrectionForm();
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('active')) {
        modal.classList.remove('active');
        resetCorrectionForm();
      }
    });
  })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\admin.blade.php ENDPATH**/ ?>