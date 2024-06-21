@extends('layouts.adm-main')

@section('content')

<div class="container">
    <h3 class="mb-4">Summary</h3>

    <!-- Content Row -->
    <div class="row">

<!-- dashboard -->
<div class="col-xl-3 col-md-6 mb-4" onclick="location.href='{{route('kategori.index')}}';" style="cursor: pointer;">
    <div class="card border-left-success shadow h-100 py-2 card-hover">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Kategori
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kategori }}</div>
                </div>
                <div class="col-auto"> 
                    <i class="fas fa-list-ol fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4" onclick="location.href='{{route('barang.index')}}';" style="cursor: pointer;">
    <div class="card border-left-primary shadow h-100 py-2 card-hover">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Barang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4" onclick="location.href='{{route('barangmasuk.index')}}';" style="cursor: pointer;">
    <div class="card border-left-danger shadow h-100 py-2 card-hover">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Barang Masuk
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $barangmasuk }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4" onclick="location.href='{{route('barangkeluar.index')}}';" style="cursor: pointer;">
    <div class="card border-left-info shadow h-100 py-2 card-hover">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Barang Keluar</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barangkeluar }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Content Row -->
@endsection