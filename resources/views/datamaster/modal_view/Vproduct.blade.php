<!-- Modal Edit data -->
@foreach ($product_header as $dataHeader)
    <div class="modal fade" id="LihatData{{ $dataHeader->kode_barang }}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="LihatDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="LihatDataLabel">Produk : <strong> {{ $dataHeader->nama_barang }}
                        </strong> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataHeader->ProdukDetailKodeBarang as $detail)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    @foreach ($detail->warna as $color)
                                        <td>{{ $color->nama_warna }}</td>
                                    @endforeach
                                    <td>{{ $detail->current_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
{{-- End Modal Edit data --}}
