@extends('layouts.app')

@section('title', 'Tambah Wali Santri - Admin')

@section('content')

<div class="form-page">
  <div class="form-header">
    <h1>Tambah Wali Santri</h1>
    <p>Isi data wali santri baru untuk ditambahkan ke sistem.</p>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('admin.wali.store') }}">
      @csrf

      <div class="form-group">
        <label for="name">Nama Wali *</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required />
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" />
        @error('username')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required />
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" />
        @error('phone')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" />
        @error('address')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Simpan Wali Santri</button>
        <a href="{{ route('data-wali-santri') }}" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


