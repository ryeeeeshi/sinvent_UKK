@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('barangkeluar.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal Keluar">
                            
                                <!-- error message untuk nama -->
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Quantity Keluar</label>
                                <input type="text" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar') }}" placeholder="Masukkan Quantity">
                            
                                <!-- error message untuk nis -->
                                @error('qty_keluar')
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