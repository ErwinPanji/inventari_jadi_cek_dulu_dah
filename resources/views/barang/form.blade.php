<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal" id="barang-form">
            @csrf
            @method('POST')

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-form">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <select class="form-control select2 select2bs4" style="width: 100%;" name="jenis_barang" id="jenis_barang" required>
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Penyedia" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary">Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>      
    </div>
</div>
