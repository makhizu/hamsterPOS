@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Produk</h1>
        {{-- alert tambah data sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('successDelete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successDelete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('errorDelete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errorDelete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('successUpdate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successUpdate') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- end alert tambah data --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
                <div class="ml-auto p-2 bd-highlight">
                    <a type="button" class="btn btn-primary" href="{{ route('produk.create') }}">
                        <i class="fas fa-plus-circle"></i> Tambah Data
                    </a>
                    <!-- Button trigger modal tambah data -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahData">
                        <i class="fas fa-plus-circle"></i> Tambah Data
                    </button> --}}
                    @include('datamaster.modal_view.Vproduct')


                    {{-- @include('datamaster.modal_edit.Ewarna') --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>Kode</th>
                                <th>Ukuran</th>
                                <th>Model</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>HPP</th>
                                <th></th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Size</th>
                                <th>Nama Kode</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($product_header as $dataHeader)
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $dataHeader->kode_barang }}</td>
                                    <td>Ukuran</td>
                                    <td>Model</td>
                                    <td>{{ $dataHeader->nama_barang }}</td>
                                    <td>Stok</td>
                                    <td>HPP</td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="badge badge-primary border-0" data-placement="top"
                                            title="Lihat Data" data-toggle="modal"
                                            data-target="#LihatData{{ $dataHeader->kode_barang }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a type="button" class="badge badge-warning border-0 ml-2" data-placement="top"
                                            title="Edit Data"
                                            href="{{ route('produk.edit', ['produk' => $dataHeader->id]) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', ['produk' => $dataHeader->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="badge badge-danger border-0 ml-2" data-placement="top"
                                                title="Hapus Data" onclick="return confirm('Yakin Hapus Data ?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
