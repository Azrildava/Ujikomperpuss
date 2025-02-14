@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('edit penulis') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('penulis.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('penulis.update', $penulis->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                      <div class="mb-3">
                        <label class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control @error('nama_penulis') is-invalid @enderror" name="nama_penulis"
                            value="{{old ('nama_penulis')}}" placeholder="nama_penulis" required>
                        @error('nama_penulis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-sm btn-warning">RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
