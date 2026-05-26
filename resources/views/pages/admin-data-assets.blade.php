@extends('layouts.app')

@section('title', 'Manajemen Aset - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <h1>Manajemen Aset</h1>
    <div class="top-actions">
      <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Admin</a>
      <button id="open-create-asset-modal" class="btn-primary" type="button">+ Tambah Aset</button>
    </div>
  </div>

  <div id="create-asset-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-create-asset-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Tambah Aset Baru</h2>
      <form method="POST" action="{{ route('store-asset') }}" enctype="multipart/form-data" class="form-grid">
        @csrf
        <div class="form-columns">
          <input type="text" name="title" placeholder="Judul aset" required class="form-control">
          <select name="type" required class="form-control">
            <option value="">Pilih tipe aset</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="ebook">Ebook</option>
          </select>
        </div>
        <input type="text" name="tags" placeholder="Tag (pisah koma)" class="form-control">
        <textarea name="description" rows="3" placeholder="Deskripsi singkat" class="form-control"></textarea>
        <input type="file" name="file" required class="form-control file">
        <div class="form-row">
          <button type="button" id="cancel-create-asset-modal" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Simpan Aset</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="{{ route('data-assets') }}" class="filter-bar">
    <input type="text" name="q" placeholder="Cari judul..." value="{{ request('q') }}" class="form-control">
    <select name="type" class="form-control">
      <option value="">Semua tipe</option>
      <option value="image" {{ request('type') === 'image' ? 'selected' : '' }}>Image</option>
      <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>Video</option>
      <option value="ebook" {{ request('type') === 'ebook' ? 'selected' : '' }}>Ebook</option>
    </select>
    <input type="text" name="tags" placeholder="Tag (pisah koma)" value="{{ request('tags') }}" class="form-control">
    <button class="btn-primary compact">Filter</button>
  </form>

  @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
  @endif

  <div class="table-container">
    @if($assets->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tipe</th>
            <th>Uploaded</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($assets as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ ucfirst($item->type) }}</td>
              <td>{{ $item->created_at->format('d M Y H:i') }}</td>
              <td>
                <div class="table-actions">
                  @foreach($item->tags as $tag)
                    <span class="badge-pill">{{ $tag->name }}</span>
                  @endforeach
                </div>
                <div class="action-buttons">
                  @if(!empty($item->file_path))
                    <a href="{{ route('download-asset', $item) }}" class="btn-download">Download</a>
                  @endif
                  <a href="{{ route('edit-asset', $item) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('delete-asset', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aset ini?');" class="inline-block">
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
      <div class="pagination-wrapper">{{ $assets->appends(request()->all())->links() }}</div>
    @else
      <div class="empty-state">Belum ada aset terunggah.</div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-create-asset-modal');
    const closeModal = document.getElementById('close-create-asset-modal');
    const cancelModal = document.getElementById('cancel-create-asset-modal');
    const modal = document.getElementById('create-asset-modal');

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


