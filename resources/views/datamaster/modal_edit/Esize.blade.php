<!-- Modal Edit data -->
@foreach ($size as $dataSize)
    <div class="modal fade" id="EditData{{ $dataSize->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                    <form action="{{ route('size.update', ['id' => $dataSize->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="inputNama4">Nama Size</label>
                            <input type="text" class="form-control" id="inputNama4" name="nama_size"
                                placeholder="Contoh : Dewasa" value="{{ $dataSize->nama_size }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDeskripsi">Keterangan</label>
                            <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi"
                                value="{{ $dataSize->deskripsi }}">
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
