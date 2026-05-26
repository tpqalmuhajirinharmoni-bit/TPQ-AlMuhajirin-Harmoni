@extends('layouts.app')

@section('title', 'Edit Data Santri')

@section('content')

<div class="form-page">
  <div class="form-header">
    <h1>Edit Data Santri</h1>
    <p>Perbarui informasi santri</p>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('update-santri', $user) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name">Nama Lengkap *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="nickname">Nama Panggilan *</label>
        <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}" required />
        @error('nickname')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" readonly />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" />
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="birth_place">Tempat Lahir *</label>
        <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place', $user->birth_place) }}" required />
        @error('birth_place')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="birth_date">Tanggal Lahir *</label>
        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required />
        @error('birth_date')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="age">Umur</label>
        <input type="text" id="age" name="age" value="{{ old('age', $user->age) }}" readonly />
      </div>

      <div class="form-group">
        <label for="guardian_id">Wali Santri *</label>
        <select id="guardian_id" name="guardian_id" required>
          <option value="">Pilih Wali Santri</option>
          @foreach($guardians as $guardian)
            <option value="{{ $guardian->id }}" data-address="{{ $guardian->address }}" {{ old('guardian_id', $user->guardian_id) == $guardian->id ? 'selected' : '' }}>{{ $guardian->name }} ({{ $guardian->username }})</option>
          @endforeach
        </select>
        @error('guardian_id')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="address">Alamat Santri</label>
        <textarea id="address" name="address" rows="3" readonly>{{ old('address', $user->address) }}</textarea>
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
        <a href="{{ route('data-santri') }}" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const birthDateInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');
    const guardianSelect = document.getElementById('guardian_id');
    const addressTextarea = document.getElementById('address');

    const updateAge = () => {
      if (!birthDateInput || !ageInput) return;
      const birthDate = birthDateInput.value;
      if (!birthDate) {
        ageInput.value = '';
        return;
      }
      const birthday = new Date(birthDate);
      const today = new Date();
      let years = today.getFullYear() - birthday.getFullYear();
      const monthDiff = today.getMonth() - birthday.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
        years -= 1;
      }
      ageInput.value = years >= 0 ? years : '';
    };

    const updateAddress = () => {
      if (!guardianSelect || !addressTextarea) return;
      const selected = guardianSelect.options[guardianSelect.selectedIndex];
      addressTextarea.value = selected ? selected.dataset.address || '' : '';
    };

    if (birthDateInput) {
      birthDateInput.addEventListener('change', updateAge);
      updateAge();
    }
    if (guardianSelect) {
      guardianSelect.addEventListener('change', updateAddress);
      updateAddress();
    }
  });
</script>
@endsection


