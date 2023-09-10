<!-- Modal Edit data -->
@foreach ($jenis as $dataJenis)
    <div class="modal fade" id="EditData{{ $dataJenis->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="EditDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDataLabel">Edit Data Ukuran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jenis.update', ['id' => $dataJenis->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="inputNama4">Nama Jenis</label>
                            <input type="text" class="form-control" id="inputNama4" name="nama_jenis"
                                value="{{ $dataJenis->nama_jenis }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDeskripsi">Keterangan</label>
                            <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi"
                                value="{{ $dataJenis->deskripsi }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
{{-- End Modal Edit data --}}
