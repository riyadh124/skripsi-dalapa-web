@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Materials</h1>
    <a href="/dashboard/material/create" class="btn btn-primary mb-3">Create New Material</a>
  </div>

  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif
  
  {{-- @dd($workorders) --}}
  
  <div class="table">
    <table class="table table-striped table-sm custom-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Harga</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($materials as $material)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $material->nama }}</td>
          <td>{{ $material->harga }}</td>
          <td>
            {{-- <a href="/dashboard/material/{{ $material->id }}" class="badge bg-info">
              <i class="bi bi-eye-fill" style="font-size: 15px"></i>
            </a> --}}
            {{-- <a href="/dashboard/posts/{{ $workorder }}/edit" class="badge bg-warning">
              <i class="bi bi-pencil-fill"  style="font-size: 15px"></i>
            </a> --}}
            <form action="/dashboard/material/{{ $material->id }}" method="POST" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"> 
              <i class="bi bi-trash-fill"  style="font-size: 15px"></i>
            </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection