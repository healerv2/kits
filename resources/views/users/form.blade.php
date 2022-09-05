<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Nama Users</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Users" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Status Akun</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status_akun" id="status_akun">
                                <option>==Pilih Status==</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="pembina">Pembina</option>
                                <option value="alumni">Alumni</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Level Akun</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="level" id="level">
                                <option>==Pilih Level==</option>
                                <option value="1">Superadmin</option>
                                <option value="2">Pembina</option>
                                <option value="3">Alumni</option>
                                <option value="4">Siswa</option>
                            </select>
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