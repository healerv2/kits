@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tutorial</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">tutorial</div>
          </div>
        </div>
        <div class="section-body">
            @if(\Session::has('alert-failed'))
            <div class="alert alert-danger text-center">
                <div>{{Session::get('alert-failed')}}</div>
            </div>
            @endif
            @if(\Session::has('alert-success'))
            <div class="alert alert-success text-center">
                <div>{{Session::get('alert-success')}}</div>
            </div>
            @endif
            @if(\Session::has('alert-warning'))
            <div class="alert alert-warning text-center">
                <div>{{Session::get('alert-warning')}}</div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                            <h4>List Tutorial</h4>
                        </div>
                        <a href="{{ route('tutorials.create') }}" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                        {{-- <button onclick="addForm('{{ route('tutorials.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Tutorial</th>
                                            <th>Author</th>
                                            <th>Kategori</th>
                                            <th>Type File</th>
                                            <th>Status</th>
                                            <th>Download</th>
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
@includeIf('tutorial.form')
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
                url: '{{ route('tutorials.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'name_tutorial'},
            {data: 'user.name'},
            {data: 'kategori.nama_kategori'},
            {data: 'extension'},
            { data: null, className: "text-center", mRender: function(data, type, full) {
              if(data.status == 1) {
                return '<span class="badge badge-success">reviewed</span>';
            }
            if(data.status == 2) {
                return '<span class="badge badge-danger">reject</span>';
            }
            if(data.status == 3) {
                return '<span class="badge badge-warning">revision</span>';
            }
            if(data.status == 4) {
                return '<span class="badge badge-info">approved</span>';
            }
            }},
            {data: 'download'},
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
