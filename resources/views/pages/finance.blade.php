@extends('layouts.app')

@section('title', 'Keuangan - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Keuangan TPQ</h2>
  <p>Data dan ringkasan transaksi keuangan terkini yang diambil langsung dari basis data.</p>
</section>

<div class="stats-section">
  <div class="stats-grid">
    <article class="stats-card">
      <span class="stats-label">Total Pendapatan</span>
      <strong>Rp {{ number_format($totalIncome, 2, ',', '.') }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Total Pengeluaran</span>
      <strong>Rp {{ number_format($totalExpense, 2, ',', '.') }}</strong>
    </article>
    <article class="stats-card">
      <span class="stats-label">Saldo Bersih</span>
      <strong>Rp {{ number_format($balance, 2, ',', '.') }}</strong>
    </article>
  </div>
</div>

<div class="card-form" style="margin-top: 2rem;">
  <h3>Transaksi Terakhir</h3>
  @if($transactions->isEmpty())
    <p>Tidak ada transaksi keuangan yang tercatat saat ini.</p>
  @else
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
        @foreach($transactions as $transaction)
          <tr>
            <td>{{ $transaction->transaction_date?->format('d M Y') ?? '-' }}</td>
            <td>{{ ucfirst($transaction->type) }}</td>
            <td>{{ $transaction->category }}</td>
            <td>{{ $transaction->type === 'expense' ? '- Rp ' : 'Rp ' }}{{ number_format($transaction->amount, 2, ',', '.') }}</td>
            <td>{{ $transaction->description ?: '—' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
