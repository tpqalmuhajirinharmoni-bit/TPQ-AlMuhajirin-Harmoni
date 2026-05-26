@extends('layouts.app')

@section('title', 'Data User - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Data User</h1>
      <p class="page-note">Tambahkan, cari, dan kirim pesan cepat ke user.</p>
    </div>
    <div class="top-actions">
      <button id="open-create-user-modal" class="btn-primary" type="button">+ Tambah User</button>
      <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Admin</a>
    </div>
  </div>

  <div id="create-user-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-create-user-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Tambah User Baru</h2>
      <form method="POST" action="{{ route('admin.user.store') }}" class="form-grid">
        @csrf
        <div class="form-columns">
          <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required class="form-control">
          @error('name')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-columns">
          <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" class="form-control">
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="form-control">
        </div>
        @error('username')
          <div class="form-error">{{ $message }}</div>
        @enderror
        @error('email')
          <div class="form-error">{{ $message }}</div>
        @enderror
        <div class="form-columns">
          <select name="role" required class="form-control">
            <option value="">Pilih role...</option>
            @foreach ($roles as $role)
              <option value="{{ $role->slug }}" {{ old('role') == $role->slug ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $role->name)) }}</option>
            @endforeach
          </select>
          @error('role')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-row">
          <button id="cancel-create-user-modal" type="button" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Buat User</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="{{ route('data-user') }}" class="filter-bar">
    <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="{{ request('q') }}" class="form-control">
    <button type="submit" class="btn-primary">Cari</button>
  </form>

  @if (session('success'))
    <div class="success-message">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-container">
    @if ($users->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $index => $user)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @foreach ($user->roles as $role)
                  <span class="badge badge-{{ $role->slug }}">
                    {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                  </span>
                @endforeach
              </td>
              <td>{{ $user->created_at->format('d M Y') }}</td>
              <td>
                <div class="action-buttons">
                  <a href="mailto:{{ $user->email }}" class="btn-download btn-mail">Kirim Pesan</a>
                  <a href="{{ route('edit-user', $user) }}" class="btn-edit">Edit</a>
                  <form method="POST" action="{{ route('delete-user', $user) }}" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
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
      <div class="empty-state">
        <p>Belum ada data user.</p>
      </div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-user-modal');
    const closeModal = document.getElementById('close-create-user-modal');
    const cancelModal = document.getElementById('cancel-create-user-modal');
    const modal = document.getElementById('create-user-modal');

    if (openModal) {
      openModal.addEventListener('click', function () {
        modal.style.display = 'flex';
      });
    }
    if (closeModal) {
      closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }
    if (cancelModal) {
      cancelModal.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }
    if (modal) {
      modal.addEventListener('click', function (event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    }
  });
</script>
@endsection


