<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal" id="sumberdana-form">
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
                        <label for="">Nama Sumber Dana</label>
                        <input type="text" name="sumberdana" id="sumberdana" class="form-control" placeholder="Sumber Dana" required autofocus>
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
