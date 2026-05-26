@extends('layouts.app')

@section('title', 'Data Wali Santri - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Data Wali Santri</h1>
      <p class="page-note">Cari dan tambahkan wali santri dengan cepat.</p>
    </div>
    <div class="top-actions">
      <button type="button" id="openAddGuardianModal" class="btn-primary">+ Tambah Wali Santri</button>
      <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Admin</a>
    </div>
  </div>

  <form method="GET" action="{{ route('data-wali-santri') }}" class="filter-bar">
    <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="{{ request('q') }}" class="form-control">
    <button type="submit" class="btn-primary">Cari</button>
  </form>

  <div id="addGuardianModal" class="modal-overlay" aria-hidden="true">
    <div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-header">
        <div>
          <h2 id="modalTitle" class="modal-title">Tambah Wali Santri</h2>
          <p class="modal-description">Isi data wali santri baru untuk ditambahkan ke sistem.</p>
        </div>
        <button type="button" class="modal-close" aria-label="Tutup">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.wali.store') }}">
          @csrf

          <div class="modal-form-group">
            <label for="name">Nama Wali *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required />
            @error('name')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>

          <div class="modal-form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" />
            @error('username')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>

          <div class="modal-form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required />
            @error('email')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>

          <div class="modal-form-group">
            <label for="phone">Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" />
            @error('phone')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>

          <div class="modal-actions">
            <button type="submit" class="btn-primary">Simpan Wali Santri</button>
            <button type="button" class="btn-cancel modal-close">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="table-container">
    @if($guardians->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($guardians as $index => $guardian)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $guardian->name }}</td>
              <td>{{ $guardian->email }}</td>
              <td>{{ $guardian->phone ?? '-' }}</td>
              <td>{{ $guardian->created_at->format('d M Y') }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('edit-wali', $guardian) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('delete-wali', $guardian) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data wali santri ini?');">
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
      <div class="empty-state">Belum ada data wali santri.</div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addGuardianModal');
    const openButton = document.getElementById('openAddGuardianModal');
    const closeButtons = modal ? modal.querySelectorAll('.modal-close') : [];

    function openModal() {
      if (!modal) return;
      modal.classList.add('active');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      if (!modal) return;
      modal.classList.remove('active');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    if (openButton) {
      openButton.addEventListener('click', openModal);
    }

    closeButtons.forEach(function (button) {
      button.addEventListener('click', closeModal);
    });

    if (modal) {
      modal.addEventListener('click', function (event) {
        if (event.target === modal) {
          closeModal();
        }
      });
    }

    @if ($errors->any())
      openModal();
    @endif
  });
</script>
@endpush


