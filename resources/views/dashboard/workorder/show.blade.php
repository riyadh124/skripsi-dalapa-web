@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <h1 class="mb-3 mt-3">{{ $workorder->nomor_tiket }}</h1>
    <a href="/dashboard/workorder" class="btn btn-success"> <i class="bi bi-arrow-left"
            style="font-size: 15px"></i> Back to all workorders</a>
    {{-- <a href="/dashboard/workorder/{{ $workorder->id }}/edit" class="btn btn-warning"> <i
            class="bi bi-pencil-fill" style="font-size: 15px"></i> Edit</a> --}}
    <form action="/dashboard/workorder/{{ $workorder->id }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')">
            <i class="bi bi-trash-fill" style="font-size: 15px"></i>
            Delete
        </button>
    </form>

    <div class="row my-3 custom-table">
        <div class="col-8">
            <div class="my-3">
                <h5 style="font-weight: bold">Nomor Tiket</h5>
                <h6>{{ $workorder->nomor_tiket }}</h6>
            </div>
            <div class="mb-3">
                <h5 style="font-weight: bold">Witel</h5>
               <h6>{{ $workorder->witel }} </h6>
            </div>
            <div class="mb-3">
                <h5 style="font-weight: bold">STO</h5>
               <h6>{{ $workorder->sto }} </h6>
            </div>
            <div class="mb-3">
                <h5 style="font-weight: bold">Headline</h5>
               <h6>{{ $workorder->headline }} </h6>
            </div>
            <div class="mb-3">
                <h5 style="font-weight: bold">Kordinat</h5>
               <h6>{{ $workorder->lat }}, {{ $workorder->lng}} </h6>
            </div>
            <div class="mb-3">
                <h5 style="font-weight: bold">Status</h5>
               <h6>{{ $workorder->status }}</h6>
            </div>

            @if ( $workorder->user)
                <div class="mb-3">
                    <h5 style="font-weight: bold">Teknisi</h5>
                   <h6>{{ $workorder->user->name }}</h6>
                </div>
            @endif

            <div class="mb-3">
                <h5 style="font-weight: bold">Dokumentasi Sebelum Perbaikan</h5>
                <img src="http://127.0.0.1:8000/storage/images/1721057360.jpg" style="height: 200px; object-fit: fit;"
                        class="img-fluid img-thumbnail">
                        {{-- <img src="{{ asset('storage/' . $workorder->evidence_before) }}" style="height: 200px; object-fit: fit;"
                        class="img-fluid img-thumbnail"> --}}
            </div>

            <div class="mb-3">
                <h5 style="font-weight: bold">Dokumentasi Setelah Perbaikan</h5>
                <img src="http://127.0.0.1:8000/storage/images/1721812497.jpg" style="height: 200px; object-fit: fit;"
                        class="img-fluid img-thumbnail">
                {{-- <img src="{{ asset('storage/' . $workorder->evidence_after) }}" style="height: 200px; object-fit: fit;"
                        class="img-fluid img-thumbnail"> --}}
            </div>
           
            <div class="mb-3">
                <h5 style="font-weight: bold">Created At</h5>
               <h6>{{ $workorder->created_at }}</h6>
            </div>

            <div class="mb-3">
                <h5 style="font-weight: bold">List Material yang digunakan</h5>
                  <ul>
                      @foreach ($listMaterials as $listMaterial)
                              <div style="display: flex; align-items: center;">
                                      <li>
                                          <h6>{{ $listMaterial->material->nama }} x {{ $listMaterial->count }} Pcs =
                                          Rp {{ number_format( $listMaterial->material->harga * $listMaterial->count, 0, ',', '.') }}</h6>
                                      </li>
                              </div>
                          @endforeach
                  </ul>
            </div>
            
            <!-- Tombol Approve dan Pending -->
            <div class="mb-3">
                @if($workorder->status === 'waiting')
                <form action="{{ route('workorder.updateStatus', $workorder->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="status" value="complete" class="btn btn-primary">Approve</button>
                    <button type="submit" name="status" value="pending" class="btn btn-warning">Pending</button>
                </form>
                @endif
            </div>

            <!-- Form untuk catatan jika status adalah Pending -->
            @if($workorder->status === 'pending' && $workorder->catatan == null)
            <div class="mb-3">
                <form action="{{ route('workorder.addNote', $workorder->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="note" class="form-label">Catatan</label>
                        <textarea id="note" name="note" class="form-control" rows="3" placeholder="Masukkan catatan..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Catatan</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
