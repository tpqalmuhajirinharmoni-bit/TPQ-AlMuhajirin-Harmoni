@extends('layouts.app')

@section('title', 'Kelola Kontak - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <h1>Kelola Pesan Kontak</h1>
    <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Admin</a>
  </div>

  @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
  @endif

  <div class="card-section">
    <h2>Tambah Pesan Kontak</h2>
    <form action="{{ route('store-contact-message') }}" method="POST" class="contact-form">
      @csrf
      <div class="form-row">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required />
      </div>
      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required />
      </div>
      <div class="form-row">
        <label>Telepon</label>
        <input type="text" name="phone" value="{{ old('phone') }}" />
      </div>
      <div class="form-row">
        <label>Subjek</label>
        <input type="text" name="subject" value="{{ old('subject') }}" required />
      </div>
      <div class="form-row">
        <label>Pesan</label>
        <textarea name="message" rows="4" required>{{ old('message') }}</textarea>
      </div>
      <button type="submit" class="btn-primary">Tambahkan Pesan</button>
    </form>
  </div>

  <div class="table-container">
    @if($messages->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Subjek</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $index => $message)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $message->name }}</td>
              <td>{{ $message->email }}</td>
              <td>{{ $message->phone ?? '-' }}</td>
              <td>{{ $message->subject }}</td>
              <td class="message-text">{{ $message->message }}</td>
              <td>{{ $message->created_at->format('d M Y, H:i') }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('edit-contact-message', $message) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('delete-contact-message', $message) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="empty-state">Belum ada pesan kontak.</div>
    @endif
  </div>
</div>
@endsection


