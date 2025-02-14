 @extends('layouts.admin')
 @section('content')
     <div class="card  m-4 card-primary card-outline mb-4">
         <div class="card-header">Tambah Penerbit
             <a href="{{ route('penerbit.index') }}" class="btn btn-sm btn-primary" style="float: right;">Kembali</a>
         </div>
         <div class="card-body">
             <form action="{{ route('penerbit.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                     <div class="col">
                         <div class="mb-3">
                             <label for="form-label">Nama Penerbit</label>
                             <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" name="nama_penerbit"
                                 value="{{ old('nama_penerbit') }}" placeholder="nama_penerbit" required>
                             @error('nama_penerbit')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
                 <div class="mb-3">
                     <div class="d-md-flex d-grid align-items-center gap-3">
                         <button type="submit" class="btn btn-primary px-4">Submit</button>
                         <button type="reset" class="btn btn-warning  px-4">Reset</button>
                     </div>
                 </div>
         </div>
         </form>
     </div>
 @endsection
