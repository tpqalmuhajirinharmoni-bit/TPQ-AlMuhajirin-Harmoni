@extends('layouts.app')

@section('title', $topic->title . ' - Forum TPQ Al Muhajirin Harmoni')

@section('content')
`r`n<div class="topic-container">
  <a href="{{ route('forum') }}" class="back-link">← Kembali ke Forum</a>

  @if (session('success'))
    <div class="alert">{{ session('success') }}</div>
  @endif

  <div class="topic-card">
    <div class="topic-header">
      <div>
        <h1 class="topic-title">{{ $topic->title }}</h1>
        <div class="topic-meta">
          <span>oleh <strong>{{ $topic->user->name }}</strong></span>
          <span>{{ $topic->created_at->format('d M Y H:i') }}</span>
          <span>{{ $topic->views_count }} kali dilihat</span>
        </div>
      </div>
      <div class="topic-badges">
        <span class="badge category">{{ ucfirst($topic->category) }}</span>
        <span class="badge stats">{{ $topic->replies_count }} Balasan</span>
      </div>
    </div>

    <div class="topic-body">{{ $topic->content }}</div>
  </div>

  @foreach ($topic->replies as $reply)
    <div class="reply-card">
      <div class="reply-header">
        <div>
          <div class="reply-author">{{ $reply->user->name }}</div>
          <div class="reply-meta">{{ $reply->created_at->format('d M Y H:i') }}</div>
        </div>
      </div>
      <div class="reply-body">{{ $reply->content }}</div>
    </div>
  @endforeach

  <div class="reply-form-card">
    <h3>Tambahkan Balasan</h3>
    <form method="POST" action="{{ route('forum.reply.store', $topic) }}">
      @csrf
      <div class="form-group">
        <label>Balasan</label>
        <textarea name="content" required>{{ old('content') }}</textarea>
        @error('content')
          <p style="color: #dc2626; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror
      </div>
      <button type="submit" class="button">Kirim Balasan</button>
    </form>
  </div>
</div>
@endsection

