<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal" id="pemohon-form">
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
                        <label for="">Nama Pemohon</label>
                        <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" placeholder="Nama Pemohon" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">NIP/NIIKI</label>
                        <input type="text" name="nip_niiki" id="nip_niiki" class="form-control" placeholder="NIP/NIIKI" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
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
