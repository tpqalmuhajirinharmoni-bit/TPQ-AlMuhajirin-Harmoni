@extends('layouts.app')

@section('title', 'Data Peralatan - Admin')

@section('content')

<div class="data-page">
  <div class="page-header">
    <h1>Data Peralatan</h1>
    <a href="{{ route('admin') }}" class="btn-primary">← Kembali ke Admin</a>
  </div>

  @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
  @endif

  <div class="table-container">
    @if($equipments->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peralatan</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Tanggal Beli</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($equipments as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->category }}</td>
              <td>{{ $item->quantity }}</td>
              <td>
                @if($item->condition === 'baik')
                  <span class="badge-status badge-good">Baik</span>
                @elseif($item->condition === 'rusak ringan')
                  <span class="badge-status badge-damaged">Rusak Ringan</span>
                @else
                  <span class="badge-status badge-damaged">Rusak Berat</span>
                @endif
              </td>
              <td>{{ $item->purchase_date ? $item->purchase_date->format('d M Y') : '-' }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('edit-peralatan', $item) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('delete-peralatan', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data peralatan ini?');">
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
      <div class="empty-state">Belum ada data peralatan.</div>
    @endif
  </div>
</div>
@endsection


