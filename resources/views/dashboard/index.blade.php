@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Material Transaction</h1>
  </div>
  <div class="container">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('material.transactions') }}" class="mb-4">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="filter">Filter</label>
                <select id="filter" name="filter" class="form-control">
                    <option value="">Choose...</option>
                    <option value="daily">Hari Ini</option>
                    <option value="weekly">Per Minggu</option>
                    <option value="monthly">Per Bulan</option>
                    <option value="yearly">Per Tahun</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group col-md-3">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="table">
        <table class="table table-striped table-sm custom-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nomor Tiket</th>
                    <th scope="col">Material</th>
                    <th scope="col">Count</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materialTransactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->nomor_tiket }}</td>
                    <td>{{ $transaction->material_nama }}</td>
                    <td>{{ $transaction->count }}</td>
                    <td>Rp {{ number_format($transaction->material_harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaction->material_harga * $transaction->count, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-8 mt-3">
        <h5>Total Harga Semua Transaksi: Rp {{ number_format($totalCost, 0, ',', '.') }}</h5>
    </div>
</div>
@endsection