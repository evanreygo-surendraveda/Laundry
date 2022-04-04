@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Transaksi') }}</h1>

    <!-- Main Content goes here -->

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
            </tr>
        </thead>
        <tbody>
            <?php 
                $total_bayar=0;    
            ?>
         @foreach($details as $detail)     
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $detail->transaksi->id }}</td>
                    <td>{{ $detail->paket->jenis }}</td>
                    <td>{{ $detail->paket->harga }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp. {{ $detail->total }}</td>
                </tr>
                <?php 
                $total_bayar += $detail->total;
                ?>
            @endforeach
        </tbody>
        <tr>
            <th colspan="5">
                Total bayar
            </th>
            <th colspan="2">Rp. {{ $total_bayar }}</th>
        </tr>
    </table>
    <a href="{{ route('transaksi.index_owner') }}" class="btn mb-3">Kembali</a>
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