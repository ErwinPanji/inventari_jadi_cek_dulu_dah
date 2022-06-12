<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal" id="jenisbarang-form">
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
                        <label for="">Jenis Barang<small> *)</small></label>
                        <input type="text" name="jenisbarang" id="jenisbarang" class="form-control" placeholder="Jenis Barang" required autofocus>
                      </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Keterangan ..." style="resize: none;"></textarea>
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
