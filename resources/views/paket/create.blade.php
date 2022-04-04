@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('paket.store') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="jenis">Jenis Paket</label>
                  <select class="form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis" placeholder="Jenis Paket" autocomplete="off" value="{{ old('jenis') }}">
                  <option value="">-Pilih-</option>
                  <option value="Cuci setrika">Cuci setrika</option>
                  <option value="Cuci kering">Cuci kering</option>
                  <option value="Setrika">Setrika</option>
                  <option value="Selimut">Selimut</option>
                  <option value="Bed cover">Bed cover</option>
                  <option value="Karpet">Karpet</option>
                  </select>
                  @error('jenis')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga" autocomplete="off" value="{{ old('harga') }}">
                  @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('paket.index') }}" class="btn btn-default">Kembali</a>

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
