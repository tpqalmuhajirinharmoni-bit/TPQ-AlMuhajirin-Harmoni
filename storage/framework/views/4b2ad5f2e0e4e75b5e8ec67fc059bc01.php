

<?php $__env->startSection('title', 'Laporan Keuangan - TPQ Al Muhajirin Harmoni'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
  <h2>Laporan Keuangan</h2>
  <p>Ringkasan transaksi keuangan untuk dicetak atau diekspor.</p>
</section>

<section class="dashboard-card">
  <table style="width:100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Tipe</th>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Jumlah</th>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kategori</th>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Deskripsi</th>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e(ucfirst($transaction->type)); ?></td>
          <td style="border: 1px solid #ddd; padding: 8px;">Rp <?php echo e(number_format($transaction->amount, 2, ',', '.')); ?></td>
          <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($transaction->category); ?></td>
          <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($transaction->description); ?></td>
          <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($transaction->transaction_date->format('Y-m-d')); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Chio Files\Project\TPQ-Al-Muhajirin-Harmoni\resources\views\pages\finance-export.blade.php ENDPATH**/ ?>