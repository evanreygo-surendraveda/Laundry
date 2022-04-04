@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Transaksi') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('transaksi.create_detail') }}" class="btn btn-primary mb-3">Tambah Detail</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @foreach($transaksis as $transaksi)
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Nama</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->member->nama }}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Tanggal Transaksi</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->tgl }}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Batas Waktu Pengambilan</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->batas_waktu }}</div>
                                        </div>
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Tanggal Bayar</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->tgl_bayar }}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Status</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->status }}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Status Pembayaran</div>
                                            <div  class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->status_bayar }}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase">Nama Kasir</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800 mb-2">{{ $transaksi->user->nama }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <a href="{{ route('transaksi.edit_proses', $transaksi->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-primary mr-2">Bayar</a>
                                        <a href="{{ route('transaksi.print', $transaksi->id) }}" class="btn btn-sm btn-success mr-2"> Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <br>
    <table class="table table-striped">
        <thead bgcolor="#4e73df">
            <tr style="color: white">
                <th>No</th>
                <th>No Transaksi</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $total_bayar = 0;
        ?>
        @foreach($details as $detail)   
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $detail->transaksi->id }}</td>
                    <td>{{ $detail->paket->jenis }}</td>
                    <td>Rp. {{ $detail->paket->harga }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp. {{ $detail->total }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('transaksi.edit_detail', $detail->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('transaksi.destroy_detail', $detail->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
                    $total_bayar += $detail->total;
                ?> 
                @endforeach
        </tbody>
        <tr>
            <th colspan="5">Total bayar</th>
            <th colspan="2">Rp. {{ $total_bayar }}</th>
        </tr>
    </table>
    <div class="row">
        <a href="{{ route('transaksi.index') }}" class="btn mb-3">Kembali</a>
    </div>
    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush