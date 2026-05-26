@extends('layouts.app')

@section('title', isset($asset) ? 'Edit Aset - Admin' : 'Tambah Aset - Admin')

@section('content')
<div class="form-page">
  <div class="page-header">
    <h1>{{ isset($asset) ? 'Edit Aset' : 'Tambah Aset' }}</h1>
    <a href="{{ route('data-assets') }}" class="btn-cancel">← Kembali</a>
  </div>

  @if($errors->any())
    <div class="alert-box">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="form-card">
    @if(isset($asset))
      <form action="{{ route('update-asset', $asset) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
      <form action="{{ route('store-asset') }}" method="POST" enctype="multipart/form-data">
    @endif
      @csrf

      <label for="title">Judul</label>
      <input type="text" id="title" name="title" value="{{ old('title', $asset->title ?? '') }}" required>

      <label for="type">Tipe</label>
      <select id="type" name="type" required>
        <option value="image" {{ old('type', $asset->type ?? '') === 'image' ? 'selected' : '' }}>Image</option>
        <option value="video" {{ old('type', $asset->type ?? '') === 'video' ? 'selected' : '' }}>Video</option>
        <option value="ebook" {{ old('type', $asset->type ?? '') === 'ebook' ? 'selected' : '' }}>Ebook / Dokumen</option>
      </select>

      <label for="description">Deskripsi (opsional)</label>
      <textarea id="description" name="description" rows="4">{{ old('description', $asset->description ?? '') }}</textarea>

      <label for="tags">Tag (pisah koma)</label>
      <input type="text" id="tags" name="tags" value="{{ old('tags', isset($asset) ? $asset->tags->pluck('name')->implode(', ') : '') }}">

      <label for="storage_disk">Penyimpanan</label>
      <select id="storage_disk" name="storage_disk">
        <option value="public" {{ old('storage_disk', $asset->storage_disk ?? 'public') === 'public' ? 'selected' : '' }}>Local (public)</option>
        <option value="s3" {{ old('storage_disk', $asset->storage_disk ?? '') === 's3' ? 'selected' : '' }}>Amazon S3</option>
      </select>

      <label for="file">File {{ isset($asset) ? '(unggah untuk mengganti)' : '' }}</label>
      <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.epub,.doc,.docx,.txt">

      @if(isset($asset) && !empty($asset->file_path))
        <div class="preview">
          @if($asset->type === 'image')
            <img src="{{ asset('storage/' . $asset->file_path) }}" alt="preview">
          @else
            <video controls>
              <source src="{{ asset('storage/' . $asset->file_path) }}" />
              Your browser does not support the video tag.
            </video>
          @endif
        </div>
        @if($asset->versions->count() > 0)
          <div class="version-box">
            <h3>Versi Sebelumnya</h3>
            <ul class="version-list">
              @foreach($asset->versions as $version)
                <li class="version-item">
                  <strong>v{{ $version->id }}</strong> — {{ $version->created_at->format('d M Y H:i') }}
                  <a href="{{ route('download-asset-version', [$asset, $version->id]) }}" class="version-link">Download</a>
                  <form method="POST" action="{{ route('rollback-asset-version', [$asset, $version->id]) }}" class="version-form">
                    @csrf
                    <button type="submit" onclick="return confirm('Rollback ke versi ini?')" class="version-button">Rollback</button>
                  </form>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      @endif

      <div class="button-group">
        <button type="submit" class="btn-submit">{{ isset($asset) ? 'Simpan Perubahan' : 'Unggah Aset' }}</button>
        <a href="{{ route('data-assets') }}" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
