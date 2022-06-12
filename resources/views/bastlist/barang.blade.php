<div class="modal fade" id="modal-barang" role="dialog" aria-labelledby="modal-barang">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-form">Daftar Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-barang">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Instock</th>
                            <th>Satuan</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $key => $item)
                            <tr>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->jumlah_instock }}</td>
                                <td>{{ $item->satuan}}</td>
                                <td><a onclick="pilihBarang('{{ $item->kode_barang }}')" href="#" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i> Pilih</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>      
    </div>
</div>
