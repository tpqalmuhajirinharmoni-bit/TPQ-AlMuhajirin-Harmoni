

<?php $__env->startSection('title', 'Keuangan - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Keuangan TPQ</h2>
  <p>Data dan ringkasan transaksi keuangan terkini yang diambil langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Total Pendapatan</span>
      <strong>Rp <?php echo e(number_format($totalIncome, 2, ',', '.')); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Pengeluaran</span>
      <strong>Rp <?php echo e(number_format($totalExpense, 2, ',', '.')); ?></strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Saldo Bersih</span>
      <strong>Rp <?php echo e(number_format($balance, 2, ',', '.')); ?></strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Transaksi Terakhir</h3>
  <?php if($transactions->isEmpty()): ?>
    <p>Tidak ada transaksi keuangan yang tercatat saat ini.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Tipe</th>
          <th>Kategori</th>
          <th>Jumlah</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($transaction->transaction_date?->format('d M Y') ?? '-'); ?></td>
            <td><?php echo e(ucfirst($transaction->type)); ?></td>
            <td><?php echo e($transaction->category); ?></td>
            <td><?php echo e($transaction->type === 'expense' ? '- Rp ' : 'Rp '); ?><?php echo e(number_format($transaction->amount, 2, ',', '.')); ?></td>
            <td><?php echo e($transaction->description ?: '—'); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\finance.blade.php ENDPATH**/ ?>