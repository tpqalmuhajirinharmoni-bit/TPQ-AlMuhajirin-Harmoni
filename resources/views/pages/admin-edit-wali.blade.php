@extends('layouts.app')

@section('title', 'Edit Wali Santri - Admin')

@section('content')

<div class="edit-page">
  <div class="page-header">
    <h1>Edit Wali Santri</h1>
  </div>

  <div class="form-container">
    <form method="POST" action="{{ route('update-wali', $user) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="0812xxxxxx">
        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
        @error('address') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
        <a href="{{ route('data-wali-santri') }}" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


