<!-- Modal tambah data -->
<div class="modal fade" id="TambahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="TambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data model</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('model.store') }}" method="POST" id="sizeForm">
                    @csrf
                    {{-- <div class="form-row"> --}}
                    {{-- <div class="form-group col-md-6">
                            <label for="inputKode4">Kode Jenis</label>
                            <input type="text" class="form-control @error('kode_jenis') is-invalid @enderror"
                                id="inputKode4" name="kode_jenis" value="{{ old('kode_jenis') }}" readonly>
                            @error('kode_jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                    {{-- <div class="form-row"> --}}
                    <div class="form-group">
                        <label for="forJenis">Jenis</label>
                        <select class="custom-select" required name="id_jenis">
                            <option selected></option>
                            @foreach ($Jenis as $jenisSelect)
                                <option value="{{ $jenisSelect->id }}">{{ $jenisSelect->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group col-md-6">
                            <label for="forSize">Ukuran</label>
                            <select class="custom-select">
                                <option selected></option>
                                @foreach ($Size as $sizeSelect)
                                    <option value="{{ $sizeSelect->id }}">{{ $sizeSelect->nama_size }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    {{-- </div> --}}
                    <div class="form-group">
                        <label for="inputNama4">Nama Model</label>
                        <input type="text" class="form-control" id="inputNama4" name="nama_model" required>
                    </div>
                    {{-- </div> --}}
                    <div class="form-group">
                        <label for="inputDeskripsi">Keterangan</label>
                        <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSave" onclick="save()">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal tambah data --}}
