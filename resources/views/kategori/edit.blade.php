@extends('layouts.adm-main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kategori.update', $rsetKategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="font-weight-bold">DESKRIPSI</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi', $rsetKategori->deskripsi) }}" placeholder="Masukkan Deskripsi Kategori">

                            @error('deskripsi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KATEGORI</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kategori" id="kategoriM" value="M" {{ $rsetKategori->kategori == 'M' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategoriM">
                                    M - Modal Barang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kategori" id="kategoriA" value="A" {{ $rsetKategori->kategori == 'A' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategoriA">
                                    A - Alat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kategori" id="kategoriBHP" value="BHP" {{ $rsetKategori->kategori == 'BHP' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategoriBHP">
                                    BHP - Barang Habis Pakai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kategori" id="kategoriBTHP" value="BTHP" {{ $rsetKategori->kategori == 'BTHP' ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategoriBTHP">
                                    BTHP - Barang Tidak Habis Pakai
                                </label>
                            </div>

                            @error('kategori')
                                <div class="alert alert-danger mt-2">
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