@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Tanggal Keluar</td>
                                <td>{{ $barangKeluar->tgl_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Quantity Barang</td>
                                <td>{{ $barangKeluar->qty_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Barang Id</td>
                                <td>{{ $barangKeluar->barang_id }}</td>
                            </tr>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  text-center">

                <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection