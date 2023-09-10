@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Produk</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h3 class="m-auto font-weight-bold text-primary text-left">Tambah Produk</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('produk.store') }}" method="POST" style="color: black">
                    @csrf
                    <div class="row form-group">
                        <div class="col">
                            <label for="ukuran">Ukuran</label>
                            <select class="custom-select" name="id_ukuran" required>
                                <option value="">Pilih Ukuran</option>
                                @foreach ($size as $datasize)
                                    <option value="{{ $datasize->id }} @if (old('id_ukuran') == $datasize->id) selected @endif">
                                        {{ $datasize->nama_size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="model">Model</label>
                            <select name="kode_model" id="tipemodel" required class="custom-select">
                                <option value="" selected>Pilih Model</option>
                                @foreach ($model as $datamodel)
                                    @foreach ($datamodel->jenis as $jenis)
                                        <option value="{{ $datamodel->kode_model }}">{{ $jenis->nama_jenis }} -
                                            {{ $datamodel->nama_model }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        {{-- jenis dan model --}}
                        {{-- <div class="col">
                            <label for="jenis">Jenis</label>
                            <select class="custom-select" name="jenis" required id="jenis">
                                <option selected value="">Pilih Jenis</option>
                                @foreach ($jenis as $datajenis)
                                    <option value="{{ $datajenis->id }}">{{ $datajenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="model">Model</label>
                            <select class="custom-select" id="model" name="model">
                                <option value="">Select Model</option>
                            </select>
                        </div> --}}
                        {{-- end jenis dan model --}}
                    </div>
                    <div class="row mt-3 form-group">
                        <div class="col">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" class="form-control" required name="kode_barang"
                                value="{{ old('kode_barang') }}">
                        </div>
                        <div class="col">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" required name="nama_barang"
                                value="{{ old('nama_barang') }}">
                        </div>
                        <div class="col">
                            <label for="hpp">HPP Barang</label>
                            <input type="number" class="form-control" required name="hpp_barang">
                        </div>
                    </div>
                    <div id="color-fields">
                        <div class="row">
                            <div class="col">
                                <label for="color">Warna:</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <select class="custom-select" name="warna[]" id="color" required>
                                        <option selected value="">Pilih Warna</option>
                                        @foreach ($warna as $datawarna)
                                            <option value="{{ $datawarna->id }}">{{ $datawarna->nama_warna }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="button" class="remove-color btn btn-danger">Hapus Baris</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">

                        <button type="button" id="add-color" class="btn btn-primary">Tambah Warna</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let colorFieldIndex = 1;

            $("#add-color").click(function() {
                colorFieldIndex++;
                const newColorField = `
                <div class="form-group">                    
                    <div class="row">
                        <div class="col">
                            <select class="custom-select" name="warna[]" id="color" required>
                                <option selected value="">Pilih Warna</option>
                                @foreach ($warna as $datawarna)
                                    <option value="{{ $datawarna->id }}">{{ $datawarna->nama_warna }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="remove-color btn btn-danger">Hapus Baris</button>
                        </div>
                    </div>
                </div>
            `;
                $("#color-fields").append(newColorField);
            });

            $("#color-fields").on("click", ".remove-color", function() {
                if (colorFieldIndex > 1) {
                    $(this).closest(".form-group").remove();
                    colorFieldIndex--;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#jenis').on('change', function() {
                const selectedJenis = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('get.model') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'jenis': selectedJenis
                    },
                    success: function(data) {
                        const modelSelect = $('#model');
                        modelSelect.empty();
                        modelSelect.append('<option value="">Select Model</option>');
                        $.each(data.models, function(index, model) {
                            modelSelect.append('<option value="' + model.id + '">' +
                                model.nama_model + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
