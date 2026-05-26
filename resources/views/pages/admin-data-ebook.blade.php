@extends('layouts.app')

@section('title', 'Data Ebook - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <div>
      <h1>Data Ebook</h1>
      <p>Semua ebook dan dokumen yang sudah diunggah oleh admin.</p>
    </div>
    <div class="top-actions">
      <button id="open-upload-modal" class="btn-primary" type="button">+ Upload Ebook</button>
      <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Dashboard</a>
    </div>
  </div>

  <div id="upload-ebook-modal" class="modal-overlay">
    <div class="modal-card sm">
      <button id="close-upload-modal" type="button" class="modal-close">&times;</button>
      <h2 class="modal-title">Upload Ebook Baru</h2>
      <form method="POST" action="{{ route('store-asset') }}" enctype="multipart/form-data" class="form-grid">
        @csrf
        <input type="hidden" name="type" value="ebook">
        <div class="form-columns">
          <input type="text" name="title" placeholder="Judul ebook" required class="form-control">
          <input type="text" name="tags" placeholder="Tag (pisah koma)" class="form-control">
        </div>
        <textarea name="description" rows="3" placeholder="Deskripsi singkat" class="form-control"></textarea>
        <input type="file" name="file" accept=".pdf,.epub,.doc,.docx,.txt" required class="form-control file">
        <div class="form-row">
          <button type="button" id="cancel-upload-modal" class="btn-primary cancel">Batal</button>
          <button type="submit" class="btn-primary">Upload Ebook</button>
        </div>
      </form>
    </div>
  </div>

  <form method="GET" action="{{ route('data-ebooks') }}" class="filter-bar">
    <input type="text" name="q" placeholder="Cari judul ebook..." value="{{ request('q') }}" class="form-control">
    <input type="text" name="tags" placeholder="Tag (pisah koma)" value="{{ request('tags') }}" class="form-control">
    <button type="submit">Cari</button>
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
            <th>Uploaded</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($assets as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->created_at->format('d M Y H:i') }}</td>
              <td>
                <div class="tag-list">
                  @foreach($item->tags as $tag)
                    <span class="badge-pill">{{ $tag->name }}</span>
                  @endforeach
                </div>
                <div class="action-buttons">
                  @if(!empty($item->file_path))
                    <a href="{{ route('download-asset', $item) }}" class="btn-download">Download</a>
                  @endif
                  <a href="{{ route('edit-asset', $item) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('delete-asset', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ebook ini?');" class="inline-block">
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
      <div class="pagination-wrap">{{ $assets->appends(request()->all())->links() }}</div>
    @else
      <div class="empty-state">Belum ada ebook terunggah.</div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModal = document.getElementById('open-upload-modal');
    const closeModal = document.getElementById('close-upload-modal');
    const cancelModal = document.getElementById('cancel-upload-modal');
    const modal = document.getElementById('upload-ebook-modal');

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


