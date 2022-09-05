@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Settings</a></div>
                <div class="breadcrumb-item">Settings</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">All About General Settings</h2>

            <div id="output-status"></div>
            <div class="row">
                <div class="col-md-12">
                    <form id="form-setting" method="POST" action="{{ route('settings.update') }}" class="form-setting" data-toggle="validator" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>General Settings</h4>
                            </div>
                            <div class="alert alert-info alert-dismissible" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                            </div>
                            <div class="card-body">
                                <div class="form-group row align-items-center">
                                    <label for="nama_komunitas" class="form-control-label col-sm-3 text-md-right">Nama Komunitas</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="nama_komunitas" class="form-control" id="nama_komunitas">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="nama_pembina" class="form-control-label col-sm-3 text-md-right">Nama Pembina</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="nama_pembina" class="form-control" id="nama_pembina">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="alamat" class="form-control-label col-sm-3 text-md-right">Alamat</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="alamat" class="form-control" id="alamat">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="telepon" class="form-control-label col-sm-3 text-md-right">Telepon</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="telepon" class="form-control" id="telepon">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Logo Komunitas</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="path_logo" class="form-control" id="path_logo" onchange="preview('.tampil-logo', this.files[0])">
                                        </div>
                                        <div class="form-text text-muted">The image must have a maximum size of 2MB</div>
                                        <br>
                                        <div class="tampil-logo"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@push('scripts')
<script>
    $(function () {
        showData();

        $('.form-setting').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function showData() {
        $.get('{{ route('settings.show') }}')
        .done(response => {
            $('[name=nama_komunitas]').val(response.nama_komunitas);
            $('[name=nama_pembina]').val(response.nama_pembina);
            $('[name=alamat]').val(response.alamat);
            $('[name=alamat_kantor]').val(response.alamat_kantor);
            $('[name=telepon]').val(response.telepon);

            let words = response.nama_komunitas.split(' ');
            let word  = '';
            words.forEach(w => {
                word += w.charAt(0);
            });
            $('.logo-mini').text(word);
            $('.logo-lg').text(response.nama_komunitas);

            $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                // $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`);
            })
        .fail(errors => {
            alert('Tidak dapat menampilkan data');
            return;
        });
    }
</script>
@endpush