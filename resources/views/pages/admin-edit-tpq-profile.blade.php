@extends('layouts.app')

@section('title', 'Edit Profil TPQ - Admin')

@section('content')
<div class="edit-page">
  <div class="page-header">
    <h1>Edit Profil TPQ</h1>
  </div>

  <div class="form-container">
    <div class="note-box">
      Data profil TPQ disimpan permanen di database. Gunakan form di bawah untuk memperbarui informasi umum TPQ.
    </div>

    <form method="POST" action="{{ route('update-tpq-profile') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="tpq_name">Nama TPQ</label>
        <input type="text" id="tpq_name" name="tpq_name" value="{{ old('tpq_name', $tpqSettings['tpq_name'] ?? '') }}" required>
        @error('tpq_name') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_hero_subtitle">Subjudul Hero</label>
        <input type="text" id="tpq_hero_subtitle" name="tpq_hero_subtitle" value="{{ old('tpq_hero_subtitle', $tpqSettings['tpq_hero_subtitle'] ?? '') }}" placeholder="Contoh: Pusat pembelajaran Al-Qur'an terpadu yang ...">
        @error('tpq_hero_subtitle') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_description">Deskripsi Halaman Tentang TPQ</label>
        <textarea id="tpq_description" name="tpq_description">{{ old('tpq_description', $tpqSettings['tpq_description'] ?? '') }}</textarea>
        @error('tpq_description') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_features">Fitur Utama (satu per baris)</label>
        <textarea id="tpq_features" name="tpq_features" placeholder="Pembelajaran Al-Qur'an yang terstruktur\nPembinaan karakter dan akhlak\nKegiatan komunitas dan keluarga">{{ old('tpq_features', $tpqSettings['tpq_features'] ?? '') }}</textarea>
        @error('tpq_features') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_vision">Visi</label>
        <textarea id="tpq_vision" name="tpq_vision">{{ old('tpq_vision', $tpqSettings['tpq_vision'] ?? '') }}</textarea>
        @error('tpq_vision') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_mission">Misi (satu per baris)</label>
        <textarea id="tpq_mission" name="tpq_mission" placeholder="Menyelenggarakan pendidikan Al-Qur'an yang profesional dan terstruktur\nMembimbing santri dalam pengembangan akhlak...">{{ old('tpq_mission', $tpqSettings['tpq_mission'] ?? '') }}</textarea>
        @error('tpq_mission') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_programs">Program Pembelajaran (satu per baris)</label>
        <textarea id="tpq_programs" name="tpq_programs" placeholder="Program Tahfidz Al-Qur'an\nProgram Tajwid dan Qira'at\nProgram Pendidikan Akhlak dan Keislaman">{{ old('tpq_programs', $tpqSettings['tpq_programs'] ?? '') }}</textarea>
        @error('tpq_programs') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_highlights">Keunggulan / Highlight (satu per baris)</label>
        <textarea id="tpq_highlights" name="tpq_highlights" placeholder="Metode pembelajaran yang teruji dan terstruktur\nGuru berpengalaman dan bersertifikat\nFasilitas lengkap dan suasana belajar yang kondusif">{{ old('tpq_highlights', $tpqSettings['tpq_highlights'] ?? '') }}</textarea>
        @error('tpq_highlights') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_team_members">Tim Pengurus & Guru (format: Nama | Jabatan, satu per baris)</label>
        <textarea id="tpq_team_members" name="tpq_team_members" placeholder="KH. Muhammad Syafii, Lc | Pendiri & Ketua Yayasan\nDrs. Abdul Hakim | Direktur TPQ">{{ old('tpq_team_members', $tpqSettings['tpq_team_members'] ?? '') }}</textarea>
        @error('tpq_team_members') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_years">Tahun Berdiri / Pengalaman</label>
        <input type="text" id="tpq_years" name="tpq_years" value="{{ old('tpq_years', $tpqSettings['tpq_years'] ?? '15+') }}" placeholder="Contoh: 15+ tahun">
        @error('tpq_years') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_hours">Jam Operasional</label>
        <input type="text" id="tpq_hours" name="tpq_hours" value="{{ old('tpq_hours', $tpqSettings['tpq_hours'] ?? 'Senin - Jumat: 14:00 - 17:00\nSabtu - Minggu: 08:00 - 12:00') }}" placeholder="Senin - Jumat: 14:00 - 17:00\nSabtu - Minggu: 08:00 - 12:00">
        @error('tpq_hours') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_address">Alamat TPQ</label>
        <input type="text" id="tpq_address" name="tpq_address" value="{{ old('tpq_address', $tpqSettings['tpq_address'] ?? '') }}">
        @error('tpq_address') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_phone">Telepon TPQ</label>
        <input type="text" id="tpq_phone" name="tpq_phone" value="{{ old('tpq_phone', $tpqSettings['tpq_phone'] ?? '') }}">
        @error('tpq_phone') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="tpq_email">Email TPQ</label>
        <input type="email" id="tpq_email" name="tpq_email" value="{{ old('tpq_email', $tpqSettings['tpq_email'] ?? '') }}">
        @error('tpq_email') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="logo">Logo Situs (opsional)</label>
        @if(!empty($tpqSettings['tpq_logo']))
          <div class="current-logo"><img src="{{ asset('storage/' . $tpqSettings['tpq_logo']) }}" alt="Logo" class="logo-preview" /></div>
        @endif
        <input type="file" id="logo" name="logo" accept="image/*" />
        @error('logo') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="button-group">
        <button type="submit" class="btn-submit">Simpan Profil</button>
        <a href="{{ route('admin') }}" class="btn-cancel">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
