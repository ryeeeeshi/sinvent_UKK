@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk">
                            
                                <!-- error message untuk nama -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Seri</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="seri" value="{{ old('nis') }}" placeholder="Masukkan Seri">
                            
                                <!-- error message untuk nis -->
                                @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Spesifikasi</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="spesifikasi" value="{{ old('nis') }}" placeholder="Masukkan Spesifikasi">
                            
                                <!-- error message untuk nis -->
                                @error('spesifikasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Stok</label>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="stok" value="{{ old('nis') }}" placeholder="Masukkan Stok">
                            
                                <!-- error message untuk nis -->
                                @error('stok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_id" class="font-weight-bold">Kategori</label>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="" {{ old('kategori_id') === null ? 'selected' : '' }}>Pilih Kategori</option>
                                    @foreach($rsetKategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>

 

            </div>
        </div>
    </div>
@endsection