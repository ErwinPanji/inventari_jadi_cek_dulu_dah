<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog modal-xl" role="document">
      <form action="" method="POST" class="form-horizontal" id="penerimaan-barang-form">
          @csrf
          @method('post')

          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="modal-form">Default Modal</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tanggal Terima Barang<small> *)</small></label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_penerimaan" id="tanggal_penerimaan" required/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Penyedia<small> *)</small></label>
                      <select class="form-control select2 select2bs4" style="width: 100%;" name="kode_penyedia" id="kode_penyedia" required>
                          <option value="">Pilih Penyedia</option>
                          @foreach ($penyedia as $key => $item)
                              <option value="{{ $key }}">{{ $item }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nomor/Tanda Bukti Pengiriman<small> *)</small></label>
                      <input type="text" class="form-control" name="nomor_bukti" id="nomor_bukti" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sumber Dana<small> *)</small></label>
                      <select class="form-control select2 select2bs4" style="width: 100%;" name="kode_sumber_dana" id="kode_sumber_dana" required>
                          <option value="">Pilih Sumber Dana</option>
                          @foreach ($sumberdana as $key => $item)
                              <option value="{{ $key }}">{{ $item }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tahun Anggaran<small></small></label>
                      <input type="text" class="form-control" name="tahun_anggaran" id="tahun_anggaran">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Bulan<small></small></label>
                      <select name="bulan" id="bulan" class="form-control">
                        <option value="">Pilih Bulan</option>
                        <option value= 'Januari'>Januari</option>
                        <option value= 'Februari'>Februari</option>
                        <option value= 'Maret'>Maret</option>
                        <option value= 'April'>April</option>
                        <option value= 'Mei'>Mei</option>
                        <option value= 'Juni'>Juni</option>
                        <option value= 'Juli'>Juli</option>
                        <option value= 'Agustus'>Agustus</option>
                        <option value= 'September'>September</option>
                        <option value= 'Oktober'>Oktober</option>
                        <option value= 'November'>November</option>
                        <option value= 'Desember'>Desember</option>
                    </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jenis Barang<small> *)</small></label>
                      <select class="form-control select2 select2bs4" style="width: 100%;" name="kode_jenis_barang" id="kode_jenis_barang" required>
                        <option value="">Pilih Jenis Barang</option>
                        @foreach ($jenisbarang as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama Barang<small> *)</small></label>
                      <select class="form-control select2 select2bs4" style="width: 100%;" name="kode_barang" id="kode_barang" required>
                          <option value="">Pilih Kode Barang</option>
                          @foreach ($barang as $key => $item)
                              <option value="{{ $key }}-{{ $item }}">{{ $key }} - {{ $item }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Spesifikasi</label>
                      <textarea class="form-control" name="spesifikasi" id="spesifikasi" rows="3" placeholder="Spesifikasi ..." style="resize: none;"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Jumlah<small> *)</small></label>
                      <input type="text" class="form-control" name="jumlah_barang" id="jumlah_barang" onkeyup="calculate()" required>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Satuan<small> *)</small></label>
                      <select class="form-control select2 select2bs4" style="width: 100%;" name="satuan" id="satuan" required>
                          <option value="">Pilih Sumber Dana</option>
                          @foreach ($satuan as $key => $item)
                              <option value="{{ $key }}">{{ $item }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Harga Satuan<small> *)</small></label>
                      <input type="text" class="form-control txt" name="harga_satuan" id="harga_satuan" onkeyup="calculate()" required>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Subtotal</label>
                      <input type="text" class="form-control txt" name="subtotal" id="subtotal" readonly>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>PPN</label>
                      <input type="text" class="form-control txt" name="ppn" id="ppn" readonly>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Total</label>
                      <input type="text" class="form-control txt" name="total" id="total" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Keterangan ..." style="resize: none;"></textarea>
                    </div>
                  </div>
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