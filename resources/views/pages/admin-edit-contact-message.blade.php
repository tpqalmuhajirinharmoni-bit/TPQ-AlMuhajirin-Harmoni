@extends('layouts.app')

@section('title', 'Edit Pesan Kontak - Admin')

@section('content')
<div class="data-page">
  <div class="page-header">
    <h1>Edit Pesan Kontak</h1>
    <a href="{{ route('edit-contact-us') }}" class="btn-primary">← Kembali ke Kelola Kontak</a>
  </div>

  @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
  @endif

  <div class="form-card">
    <form action="{{ route('update-contact-message', $contactMessage) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-row">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $contactMessage->name) }}" required />
        @error('name') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $contactMessage->email) }}" required />
        @error('email') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $contactMessage->phone) }}" />
        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>Subjek</label>
        <input type="text" name="subject" value="{{ old('subject', $contactMessage->subject) }}" required />
        @error('subject') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>Pesan</label>
        <textarea name="message" rows="5" required>{{ old('message', $contactMessage->message) }}</textarea>
        @error('message') <div class="error-message">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
  </div>
</div>
@endsection
