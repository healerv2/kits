@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data KITS Peduli</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">data kist peduli</div>
          </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                            <h4>List KITS Peduli</h4>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Nominal</th>
                                            <th>Referensi</th>
                                            <th>Tanggal Request</th>
                                            <th>Status</th>
                                            <th>Dibayar Pada</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.modal -->
@stop
@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('kits-peduli.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama'},
            {data: 'email'},
            {data: 'nohp'},
            {data: 'nominal'},
            {data: 'invoice'},
            {data: 'created_at'},
            { data: null, className: "text-center", mRender: function(data, type, full) {
              if(data.status == 'PENDING') {
                return '<span class="badge badge-warning">PENDING</span>';
            }
            if(data.status == 'PAID') {
                return '<span class="badge badge-success">PAID</span>';
            }
            if(data.status == 'REFUND') {
                return '<span class="badge badge-info">REFUND</span>';
            }
            if(data.status == 'EXPIRED') {
                return '<span class="badge badge-primary">EXPIRED</span>';
            }
             if(data.status == 'FAILED') {
                return '<span class="badge badge-danger">FAILED</span>';
            }
            }},
            {data: 'updated_at'},
            {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                    if(response.success){
                        return toastr.success(response.message, 'Sukses !')
                    } else
                    return toastr.error(response.message, 'Gagal !')
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Tutorial');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=name_tutorial]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Tutorial');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=name_tutorial]').focus();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=name_tutorial]').val(response.nama_kategori);
            $('#modal-form [name=kode_kategori]').val(response.kode_kategori);
            $('#modal-form [name=note_kategori]').val(response.note_kategori);

            if(response.success){
                return toastr.success(response.message, 'Sukses !')
            }
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
            return;
        });
    }

    function deleteData(url) {
        if (confirm('Anda yakin akan menghapus data ini?')) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload();
                if(response.success){
                    return toastr.success(response.message, 'Sukses !')
                }
                return toastr.error(response.message, 'Gagal !')
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
        }
    }
</script>
@endpush
