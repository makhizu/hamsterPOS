@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Model</h1>
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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                    <!-- Button trigger modal tambah data -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahData">
                        <i class="fas fa-plus-circle"></i> Tambah Data
                    </button>
                    @include('datamaster.modal_create.Cmodel')


                    @include('datamaster.modal_edit.Emodel')
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>Kode Model</th> --}}
                                <th>Kode</th>
                                <th>Jenis</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Model</th>
                                <th>Nama Kode</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($Model as $dataModel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $dataModel->kode_ }}</td> --}}
                                    <td>{{ $dataModel->kode_model }}</td>
                                    @foreach ($dataModel->jenis as $jenis)
                                        <td>{{ $jenis->nama_jenis }}</td>
                                    @endforeach
                                    <td>{{ $dataModel->nama_model }}</td>
                                    <td>{{ $dataModel->deskripsi }}</td>
                                    <td class="d-flex justify-content-center"><button type="button" data-toggle="modal"
                                            data-target="#EditData{{ $dataModel->id }}" class="btn btn-warning border-0"><i
                                                class="far fa-edit"></i></button>
                                        <form action="{{ route('model.destroy', ['model' => $dataModel->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger border-0 ml-2"
                                                onclick="return confirm('Yakin Hapus Data ?')">
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
