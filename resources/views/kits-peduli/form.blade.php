<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{-- @csrf --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Nama Tutorial</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_tutorial" id="name_tutorial" placeholder="Nama Tutorial" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kategori_id" id="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class="form-control" id="file">
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