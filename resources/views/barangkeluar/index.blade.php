@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-3">+ TAMBAH BARANG KELUAR</a>

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
                            <th>TGL KELUAR</th>
                            <th>QTT KELUAR</th>
                            <th>BARANG ID</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangKeluar as $rowbarangkeluar)
                            <tr>
                                <td>{{ $rowbarangkeluar->id  }}</td>
                                <td>{{ $rowbarangkeluar->tgl_keluar  }}</td>
                                <td>{{ $rowbarangkeluar->qty_keluar  }}</td>
                                <td>{{ $rowbarangkeluar->barang_id  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangkeluar.destroy', $rowbarangkeluar->id) }}" method="POST">
                                        <a href="{{ route('barangkeluar.show', $rowbarangkeluar->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangkeluar.edit', $rowbarangkeluar->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
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
                    <script>
                        setTimeout(function(){
                            document.querySelectorAll('.alert').forEach(function(alert){
                                alert.style.display = 'none';
                            });
                        }, 2000);
                    </script>
                </table>
                {{-- {{ $siswa->links() }} --}}
                </div>
                </div>

            </div>
        </div>
    </div>
@endsection