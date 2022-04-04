@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit transaksi') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.update_proses', $transaksi->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" placeholder="status" autocomplete="off" >
                        <option value="">-Pilih-</option>
                        <option value="baru" {{ old('status', $transaksi->status) == 'baru' ? 'selected' : null }}>Baru</option>
                        <option value="proses" {{ old('status', $transaksi->status) == 'proses' ? 'selected' : null }}>Proses</option>
                        <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : null }}>Selesai</option>
                        <option value="diambil" {{ old('status', $transaksi->status) == 'diambil' ? 'selected' : null }}>Diambil</option>
                  </select>
                      @error('status')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-default">Back to list</a>

            </form>

        </div>
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