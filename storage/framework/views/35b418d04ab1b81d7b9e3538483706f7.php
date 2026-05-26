

<?php $__env->startSection('title', $topic->title . ' - Forum TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
`r`n<div class="topic-container">
  <a href="<?php echo e(route('forum')); ?>" class="back-link">← Kembali ke Forum</a>

  <?php if(session('success')): ?>
    <div class="alert"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <div class="topic-card">
    <div class="topic-header">
      <div>
        <h1 class="topic-title"><?php echo e($topic->title); ?></h1>
        <div class="topic-meta">
          <span>oleh <strong><?php echo e($topic->user->name); ?></strong></span>
          <span><?php echo e($topic->created_at->format('d M Y H:i')); ?></span>
          <span><?php echo e($topic->views_count); ?> kali dilihat</span>
        </div>
      </div>
      <div class="topic-badges">
        <span class="badge category"><?php echo e(ucfirst($topic->category)); ?></span>
        <span class="badge stats"><?php echo e($topic->replies_count); ?> Balasan</span>
      </div>
    </div>

    <div class="topic-body"><?php echo e($topic->content); ?></div>
  </div>

  <?php $__currentLoopData = $topic->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="reply-card">
      <div class="reply-header">
        <div>
          <div class="reply-author"><?php echo e($reply->user->name); ?></div>
          <div class="reply-meta"><?php echo e($reply->created_at->format('d M Y H:i')); ?></div>
        </div>
      </div>
      <div class="reply-body"><?php echo e($reply->content); ?></div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <div class="reply-form-card">
    <h3>Tambahkan Balasan</h3>
    <form method="POST" action="<?php echo e(route('forum.reply.store', $topic)); ?>">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label>Balasan</label>
        <textarea name="content" required><?php echo e(old('content')); ?></textarea>
        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p style="color: #dc2626; margin-top: 0.5rem;"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <button type="submit" class="button">Kirim Balasan</button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\forum-topic.blade.php ENDPATH**/ ?>