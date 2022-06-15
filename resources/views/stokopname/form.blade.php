<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="{{ route('stokopname.index') }}" method="get" class="form-horizontal" id="barang-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-form">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Range Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="range_tanggal" name="range_tanggal">
                        </div>
                        <input type="hidden" name="tanggal_awal" id="tanggal_awal" value="{{request('tanggal_awal')}}"> 
                        <input type="hidden" name="tanggal_akhir" id="tanggal_akhir" value="{{request('tanggal_akhir')}}"> 
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <select class="form-control select2 select2bs4" style="width: 100%;" name="jenis_barang" id="jenis_barang" required>
                            <option value="">Pilih Jenis Barang</option>
                            <option value="all">Pilih Semua</option>
                            @foreach ($jenisbarang as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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
