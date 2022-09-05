@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Angkatan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">angkatan</div>
          </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                            <h4>List Angkatan</h4>
                        </div>
                        <button onclick="addForm('{{ route('angkatan.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Angkatan</th>
                                            <th>Deskripsi</th>
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
@includeIf('angkatan.form')
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
                url: '{{ route('angkatan.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_angkatan'},
            {data: 'note_angkatan'},
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
        $('#modal-form .modal-title').text('Tambah Layanan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_angkatan]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Layanan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_angkatan]').focus();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_angkatan]').val(response.nama_angkatan);
            $('#modal-form [name=note_angkatan]').val(response.note_angkatan);

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
