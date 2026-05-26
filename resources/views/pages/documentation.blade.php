@extends('layouts.app')

@section('title', 'Dokumentasi - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Dokumentasi Sistem</h2>
  <p>Panduan dan dokumentasi kegiatan TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Panduan Sistem</h3>
  <p>Di halaman ini Anda dapat melihat dokumentasi operasional, panduan penggunaan sistem, dan dokumentasi kegiatan TPQ dalam bentuk foto maupun video.</p>
</div>

<div class="blog-list" style="margin-top: 2rem;">
  @forelse ($media as $item)
    <div class="blog-card">
      <h3>{{ $item->title }}</h3>
      <p class="post-meta">{{ $item->type === 'video' ? 'Video dokumentasi' : 'Gambar dokumentasi' }} · {{ $item->created_at->format('d M Y') }}</p>
      <p>{{ $item->description }}</p>
      @if ($item->type === 'image')
        <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->title }}" style="max-width: 100%; border-radius: 20px; margin-top: 1rem;" />
      @else
        <video controls style="width: 100%; border-radius: 20px; margin-top: 1rem;">
          <source src="{{ Storage::url($item->file_path) }}" type="video/{{ pathinfo($item->file_path, PATHINFO_EXTENSION) }}" />
          Browser Anda tidak mendukung pemutaran video.
        </video>
      @endif
    </div>
  @empty
    <div class="blog-card">
      <h3>Belum ada dokumentasi</h3>
      <p>Silakan unggah file dokumentasi di dashboard admin untuk melihat panduan penggunaan sistem.</p>
    </div>
  @endforelse
</div>
<div style="margin-top:1.5rem;">{{ $media->links() }}</div>
@endsection
