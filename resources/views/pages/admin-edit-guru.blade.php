@extends('layouts.app')

@section('title', 'Edit Data Guru')

@section('content')

<div class="form-page">
  <div class="form-header">
    <h1>Edit Data Guru</h1>
    <p>Perbarui informasi guru</p>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('update-guru', $user) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name">Nama Guru *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required />
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" />
        @error('phone')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        <a href="{{ route('data-guru') }}" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


