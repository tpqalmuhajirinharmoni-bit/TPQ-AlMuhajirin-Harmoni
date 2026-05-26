@extends('layouts.app')

@section('title', 'Blog - TPQ Al Muhajirin Harmoni')

@section('content')
<section class="hero">
  <h2>Blog TPQ Al Muhajirin Harmoni</h2>
  <p>Artikel dan berita seputar pembelajaran Al-Qur'an.</p>
</section>

<div class="blog-list">
  @forelse ($posts as $post)
    <article class="blog-card">
      <h3>{{ $post->title }}</h3>
      <p class="post-meta">{{ optional($post->published_at ?? $post->created_at)->format('d M Y') }} · {{ $post->summary ? 'Ringkasan' : 'Postingan singkat' }}</p>
      <p>{{ $post->summary ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 180) }}</p>
    </article>
  @empty
    <div class="blog-card">
      <h3>Belum ada artikel</h3>
      <p>Postingan blog belum tersedia. Silakan buat posting baru dari dashboard admin.</p>
    </div>
  @endforelse
</div>
@endsection
