@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')

<div class="form-page">
  <div class="form-header">
    <h1>Edit Data User</h1>
    <p>Perbarui informasi dan role user</p>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('update-user', $user) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name">Nama *</label>
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
        <label for="role_id">Role *</label>
        <select id="role_id" name="role_id" required>
          <option value="">Pilih Role...</option>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', $user->roles->first()->id ?? '') == $role->id ? 'selected' : '' }}>
              {{ ucfirst(str_replace('-', ' ', $role->name)) }}
            </option>
          @endforeach
        </select>
        @error('role_id')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        <a href="{{ route('data-user') }}" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection


