@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success mb-3">+ TAMBAH BARANG MASUK</a>

                    <!-- Tambahkan pesan warning -->
                @if(session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                <!-- Tambahkan pesan sukses -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TGL MASUK</th>
                            <th>QTT MASUK</th>
                            <th>BARANG ID</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangMasuk as $rowbarangmasuk)
                            <tr>
                                <td>{{ $rowbarangmasuk->id  }}</td>
                                <td>{{ $rowbarangmasuk->tgl_masuk  }}</td>
                                <td>{{ $rowbarangmasuk->qty_masuk  }}</td>
                                <td>{{ $rowbarangmasuk->barang_id  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $rowbarangmasuk->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $rowbarangmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $rowbarangmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data Barang belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $barangmasuk->links() }} --}}
                </div>
                </div>

            </div>
        </div>
    </div>
@endsection