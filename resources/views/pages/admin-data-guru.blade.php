@extends('layouts.app')

@section('title', 'Data Guru - Admin')

@section('content')
  <div class="data-page">
    <div class="page-header">
      <div>
        <h2>Data Guru</h2>
        <p class="page-note">Kelola data guru dan cari informasi dengan mudah.</p>
      </div>
      <div class="top-actions">
        <button id="open-create-guru-modal" class="button primary" type="button">+ Tambah Guru</button>
        <a href="{{ route('admin') }}" class="button secondary">← Kembali ke Dashboard</a>
      </div>
    </div>

    <div id="create-guru-modal" class="modal-overlay">
      <div class="modal-card sm">
        <button id="close-create-guru-modal" type="button" class="modal-close">&times;</button>
        <h3 class="modal-title">Tambah Guru Baru</h3>
        <form method="POST" action="{{ route('admin.guru.store') }}" class="form-grid">
          @csrf
          <div class="form-columns">
            <input type="text" name="name" placeholder="Nama Guru" required class="form-control">
            <input type="text" name="username" placeholder="Username Guru" class="form-control">
          </div>
          <div class="form-columns">
            <input type="email" name="email" placeholder="Email Guru" class="form-control">
            <input type="text" name="specialty" placeholder="Mata Pelajaran" class="form-control">
          </div>
          <input type="text" name="contact" placeholder="Kontak Guru" class="form-control">
          <div class="form-row">
            <button type="button" id="cancel-create-guru-modal" class="button secondary cancel">Batal</button>
            <button type="submit" class="button primary">Simpan Guru</button>
          </div>
        </form>
      </div>
    </div>

    <form method="GET" action="{{ route('data-guru') }}" class="filter-bar">
      <input type="search" name="q" placeholder="Cari nama, username, atau email..." value="{{ request('q') }}" class="form-control">
      <button type="submit" class="button primary">Cari</button>
    </form>

    <div class="table-container">
      @if($guru->isEmpty())
        <div class="empty-state">Belum ada data guru.</div>
      @else
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Dibuat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($guru as $g)
              <tr>
                <td>{{ $g->name }}</td>
                <td>{{ $g->username }}</td>
                <td>{{ $g->email }}</td>
                <td>{{ $g->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('edit-guru', $g) }}">Edit</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-guru-modal');
    const closeModal = document.getElementById('close-create-guru-modal');
    const cancelModal = document.getElementById('cancel-create-guru-modal');
    const modal = document.getElementById('create-guru-modal');

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
