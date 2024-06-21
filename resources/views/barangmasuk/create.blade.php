@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Masuk</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk') }}" placeholder="Masukkan Tanggal Masuk">
                            
                                <!-- error message untuk nama -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Quantity Masuk</label>
                                <input type="text" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk') }}" placeholder="Masukkan Quantity">
                            
                                <!-- error message untuk nis -->
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="barang_id" class="font-weight-bold">Barang Id</label>
                                <input type="text" class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" value="{{ old('barang_id') }}" placeholder="Masukkan Barang Idnya">
                                <!-- error message untuk barang_id -->
                                @error('barang_id')
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