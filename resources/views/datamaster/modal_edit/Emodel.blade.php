<!-- Modal Edit data -->
@foreach ($Model as $dataModel)
    <div class="modal fade" id="EditData{{ $dataModel->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="EditDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDataLabel">Edit Data Model : {{ $dataModel->kode_model }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('model.update', ['model' => $dataModel->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="forJenis">Jenis</label>
                            <select class="custom-select" required name="id_jenis" disabled>
                                @foreach ($dataModel->jenis as $jenis)
                                    <option selected>{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputNama4">Nama Model</label>
                            <input type="text" class="form-control" id="inputNama4" name="nama_model" required
                                value="{{ $dataModel->nama_model }}">
                        </div>
                        {{-- </div> --}}
                        <div class="form-group">
                            <label for="inputDeskripsi">Keterangan</label>
                            <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi"
                                value="{{ $dataModel->deskripsi }}">
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
