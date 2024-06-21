@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.update',$rsetBarang->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk',$rsetBarang->merk) }}" placeholder="Masukkan Nama Siswa">
                            
                                <!-- error message untuk nama -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Seri</label>
                                <input type="text" class="form-control @error('seri') is-invalid @enderror" name="seri" value="{{ old('seri',$rsetBarang->seri) }}" placeholder="Masukkan Nomor Induk Siswa">
                            
                                <!-- error message untuk seri -->
                                @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Spesifikasi</label>
                                <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" value="{{ old('spesifikasi',$rsetBarang->spesifikasi) }}" placeholder="Masukkan Nomor Induk Siswa">
                            
                                <!-- error message untuk spesifikasi -->
                                @error('spesifikasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok',$rsetBarang->stok) }}" placeholder="Masukkan Nomor Induk Siswa">
                            
                                <!-- error message untuk seri -->
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
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->deskripsi }}
                                        </option>
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