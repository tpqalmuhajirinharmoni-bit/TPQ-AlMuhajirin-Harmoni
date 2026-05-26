@extends('layouts.app')

@section('title', 'Ebook - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Ebook dan Dokumen Digital</h2>
  <p>Daftar buku digital dan panduan dalam bentuk dokumen untuk TPQ Al Muhajirin Harmoni.</p>
</section>

<div class="card-form" style="max-width: 900px; margin-top: 2rem;">
  <h3>Ebook & Dokumen</h3>
  <p>Temukan materi pembelajaran, buku digital, dan dokumen penting yang dapat diunduh atau dibuka secara langsung.</p>
</div>

<div class="blog-list" style="margin-top: 2rem;">
  @forelse ($ebooks as $ebook)
    <div class="blog-card">
      <h3>{{ $ebook->title }}</h3>
      <p class="post-meta">Ebook / Dokumen · {{ $ebook->created_at->format('d M Y') }}</p>
      <p>{{ $ebook->description }}</p>

      <div style="margin-top: 1rem;">
        <a href="{{ Storage::url($ebook->file_path) }}" target="_blank" rel="noopener noreferrer" class="button">Buka / Unduh</a>
      </div>
      @if (in_array(pathinfo($ebook->file_path, PATHINFO_EXTENSION), ['pdf', 'epub']))
        <div style="margin-top: 1rem;">
          <iframe src="{{ Storage::url($ebook->file_path) }}" width="100%" height="450" style="border-radius: 20px; border: 1px solid #ddd;"></iframe>
        </div>
      @endif
    </div>
  @empty
    <div class="blog-card">
      <h3>Belum ada Ebook</h3>
      <p>Belum ada materi ebook yang tersedia. Silakan unggah ebook atau dokumen melalui dashboard admin.</p>
    </div>
  @endforelse
</div>

<div style="margin-top:1.5rem;">{{ $ebooks->links() }}</div>
@endsection
