@extends('layouts.app')

@section('title', 'Edit Keuangan - Admin')

@section('content')

<div class="edit-page">
  <div class="page-header">
    <h1>Edit Transaksi Keuangan</h1>
  </div>

  <div class="form-container">
    <div class="form-info">
      <strong>ID Transaksi:</strong> #{{ $transaction->id }}
    </div>

    <form method="POST" action="{{ route('update-keuangan', $transaction) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="type">Tipe Transaksi</label>
        <select id="type" name="type" required>
          <option value="">Pilih Tipe</option>
          <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Pemasukan</option>
          <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
        @error('type')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="category">Kategori</label>
        <input type="text" id="category" name="category" value="{{ old('category', $transaction->category) }}" placeholder="Contoh: Sumbangan, Gaji Guru, dll" required>
        @error('category')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="amount">Jumlah (Rp)</label>
        <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" min="1" placeholder="0" required>
        @error('amount')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="transaction_date">Tanggal Transaksi</label>
        <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required>
        @error('transaction_date')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea id="description" name="description" placeholder="Masukkan keterangan transaksi">{{ old('description', $transaction->description) }}</textarea>
        @error('description')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="{{ route('data-keuangan') }}" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


