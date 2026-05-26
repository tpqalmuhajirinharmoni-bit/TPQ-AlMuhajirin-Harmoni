@extends('layouts.app')

@section('title', 'Tambah User - Admin')

@section('content')

<div class="form-page">
  <div class="form-header">
    <h1>Tambah User Baru</h1>
    <p>Isi data dan pilih role untuk akun user baru.</p>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('admin.user.store') }}">
      @csrf

      <div class="form-group">
        <label for="name">Nama *</label>
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
        <label for="role">Role *</label>
        <select id="role" name="role" required>
          <option value="">Pilih role...</option>
          @foreach ($roles as $role)
            <option value="{{ $role->slug }}" {{ old('role') == $role->slug ? 'selected' : '' }}>
              {{ ucfirst(str_replace('-', ' ', $role->name)) }}
            </option>
          @endforeach
        </select>
        @error('role')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Buat User</button>
        <a href="{{ route('data-user') }}" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


