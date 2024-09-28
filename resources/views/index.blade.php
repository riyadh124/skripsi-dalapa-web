@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Peminjaman</h1>
  </div>

  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif
  @if (session()->has('fail'))
  <div class="alert alert-danger" role="alert">
    {{ session('fail') }}
  </div>
  @endif
  
  <form action="{{ route('dashboard.borrow.index') }}" method="GET"
        class="form-inline d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Cari data..." aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cari</button>
    </form>

  <div class="table-responsive small col-lg-12 mt-3">
    {{-- <a href="/dashboard/material/create" class="btn btn-primary mb-3">Create New Material</a> --}}
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Peminjam</th>
          <th scope="col">Nama Buku</th>
          <th scope="col">Dipinjam</th>
          <th scope="col">Dikembalikan</th>
          <th scope="col">Denda</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($borrows as $borrow)
        <tr>
          <td>{{ $borrow->id }}</td>
          <td>{{ $borrow->user->name }}</td>
          <td>{{ $borrow->book->judul_buku}}</td>
          <td>{{ $borrow->borrowed_at }}</td>
          <td>{{ $borrow->returned_at }}</td>
          <td>{{ $borrow->overdue_fine }}</td>
          <td>
            <form action="/dashboard/borrow/return/{{ $borrow->id }}" method="POST" class="d-inline">
            @csrf
            @if (is_null($borrow->returned_at))
            <form action="/dashboard/borrow/return/{{ $borrow->id }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-warning" onclick="return confirm('Are you sure?')">Di Kembalikan</button>
            </form>
            <form action="/dashboard/borrow/send-notification/{{ $borrow->id }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-info" onclick="return confirm('Are you sure?')">Kirim Notifikasi</button>
            </form>
            @endif
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    

    
    {{ $borrows->links('pagination::bootstrap-5') }}

  </div>
@endsection