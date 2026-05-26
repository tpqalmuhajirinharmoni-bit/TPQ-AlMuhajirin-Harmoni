

<?php $__env->startSection('title', 'Forum - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
`r`n<div class="forum-container">
  <div class="forum-header">
    <div>
      <h2>Forum Diskusi TPQ</h2>
      <p class="paragraph-muted">Berbagi informasi, tanya jawab, dan diskusi antar santri dan wali</p>
    </div>
    <?php if(auth()->guard()->check()): ?>
      <button class="new-topic-btn" onclick="openNewTopicModal()">+ Topik Baru</button>
    <?php endif; ?>
  </div>

  <?php if(session('success')): ?>
    <div class="alert-box info">

  <div class="forum-filters">
    <button class="filter-btn active" onclick="filterTopics('all')">Semua Topik</button>
    <button class="filter-btn" onclick="filterTopics('unanswered')">Belum Terjawab</button>
    <button class="filter-btn" onclick="filterTopics('solved')">Terjawab</button>
    <button class="filter-btn" onclick="filterTopics('popular')">Populer</button>
  </div>

  <?php if(auth()->guard()->check()): ?>
    <div id="newTopicModal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Buat Topik Baru</h3>
          <button class="modal-close" onclick="closeNewTopicModal()">×</button>
        </div>
        <form method="POST" action="<?php echo e(route('forum.store')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label>Judul Topik</label>
            <input type="text" name="title" placeholder="Judul pertanyaan atau diskusi" required />
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="category" required>
              <option value="">Pilih Kategori</option>
              <option value="pembelajaran">Pembelajaran</option>
              <option value="teknis">Teknis/Masalah</option>
              <option value="umum">Umum</option>
              <option value="pengumuman">Pengumuman</option>
            </select>
          </div>
          <div class="form-group">
            <label>Isi Diskusi</label>
            <textarea name="content" placeholder="Tuliskan pertanyaan atau topik diskusi Anda" required></textarea>
          </div>
          <div class="button-group">
            <button type="button" class="button secondary" onclick="closeNewTopicModal()">Batal</button>
            <button type="submit" class="button">Posting Topik</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function openNewTopicModal() {
        document.getElementById('newTopicModal').classList.add('show');
      }

      function closeNewTopicModal() {
        document.getElementById('newTopicModal').classList.remove('show');
      }

      function filterTopics(filter) {
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        // Implementasi filter dapat ditambahkan nanti dengan AJAX
      }

      window.onclick = function(event) {
        const modal = document.getElementById('newTopicModal');
        if (event.target === modal) {
          closeNewTopicModal();
        }
      }
    </script>
  <?php endif; ?>

  <div class="topic-list">
    <?php $__empty_1 = true; $__currentLoopData = $topics ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="topic-card">
        <div class="topic-header">
          <div class="topic-avatar"><?php echo e(substr($topic->user->name, 0, 1)); ?></div>
          <div class="topic-info">
            <h3 class="topic-title"><a href="<?php echo e(route('forum.topic', $topic)); ?>" class="topic-link"><?php echo e($topic->title); ?></a></h3>
            <div class="topic-meta">
              <span>oleh <strong><?php echo e($topic->user->name); ?></strong></span>
              <span><?php echo e($topic->created_at->diffForHumans()); ?></span>
              <span class="topic-badge"><?php echo e(ucfirst($topic->category)); ?></span>
            </div>
          </div>
        </div>
        <p class="topic-preview"><?php echo e(Str::limit($topic->content, 150)); ?></p>
        <div class="topic-stats">
          <span>💬 <?php echo e($topic->replies_count ?? 0); ?> Balasan</span>
          <span>👁️ <?php echo e($topic->views_count ?? 0); ?> Dilihat</span>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="empty-state">
        <h3>Belum ada topik diskusi</h3>
        <p>Jadilah yang pertama untuk memulai diskusi. Klik tombol "Topik Baru" di atas untuk membuat topik.</p>
        <?php if(auth()->guard()->check()): ?>
          <button class="button button-spaced" onclick="openNewTopicModal()">Buat Topik Pertama</button>
        <?php else: ?>
          <p class="topic-list-empty">
            <a href="<?php echo e(route('login')); ?>" class="button">Login untuk Membuat Topik</a>
          </p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\forum.blade.php ENDPATH**/ ?>