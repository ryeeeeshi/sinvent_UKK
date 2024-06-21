@extends('layouts.adm-main')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Kategori {{ $rsetKategori->id }}</h4>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>: {{ $rsetKategori->id }}</td>
                        </tr>
                        <tr>
                            <td>DESKRIPSI</td>
                            <td>: {{ $rsetKategori->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>KATEGORI</td>
                            <td>: {{ $rsetKategori->kategori }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12  text-center">
            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary mb-3 mt-3">BACK</a>
        </div>
    </div>
</div>
@endsection