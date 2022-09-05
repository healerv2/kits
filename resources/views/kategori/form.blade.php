<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Kode Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" placeholder="Kode Kategori" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Diskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="note_kategori" id="note_kategori" placeholder="Diskripsi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>