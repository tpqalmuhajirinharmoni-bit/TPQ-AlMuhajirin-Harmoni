@extends('layouts.app')

@section('title', 'Laporan Keuangan - TPQ Al Muhajirin Harmoni')

@section('content')
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
      @foreach ($transactions as $transaction)
        <tr>
          <td style="border: 1px solid #ddd; padding: 8px;">{{ ucfirst($transaction->type) }}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">Rp {{ number_format($transaction->amount, 2, ',', '.') }}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{ $transaction->category }}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{ $transaction->description }}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{ $transaction->transaction_date->format('Y-m-d') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection
