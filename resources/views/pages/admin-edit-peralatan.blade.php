@extends('layouts.app')

@section('title', 'Edit Peralatan - Admin')

@section('content')

<div class="edit-page">
  <div class="page-header">
    <h1>Edit Peralatan</h1>
  </div>

  <div class="form-container">
    <form method="POST" action="{{ route('update-peralatan', $equipment) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name">Nama Peralatan</label>
        <input type="text" id="name" name="name" value="{{ old('name', $equipment->name) }}" required>
        @error('name') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="category">Kategori</label>
        <input type="text" id="category" name="category" value="{{ old('category', $equipment->category) }}" required>
        @error('category') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="quantity">Jumlah</label>
        <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $equipment->quantity) }}" required>
        @error('quantity') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="condition">Kondisi</label>
        <select id="condition" name="condition" required>
          <option value="">Pilih Kondisi</option>
          <option value="baik" {{ old('condition', $equipment->condition) === 'baik' ? 'selected' : '' }}>Baik</option>
          <option value="rusak ringan" {{ old('condition', $equipment->condition) === 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
          <option value="rusak berat" {{ old('condition', $equipment->condition) === 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
        @error('condition') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="purchase_date">Tanggal Pembelian</label>
        <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', optional($equipment->purchase_date)->format('Y-m-d')) }}">
        @error('purchase_date') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea id="description" name="description">{{ old('description', $equipment->description) }}</textarea>
        @error('description') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="{{ route('data-peralatan') }}" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


