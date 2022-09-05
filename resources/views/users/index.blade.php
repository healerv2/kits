@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">users</div>
          </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                            <h4>List Users</h4>
                        </div>
                        {{-- <button onclick="addForm('{{ route('users.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                           {{--  <th>Phone/No Hp</th> --}}
                                            <th>Foto</th>
                                            <th>Status Akun</th>
                                            <th>Aktivitas</th>
                                            <th>Level</th>
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
@includeIf('users.form')
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
                url: '{{ route('users.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'name'},
            {data: 'email'},
            // {data: 'phone'},
            {data: 'foto', 
                render: function (data, type, full, meta) {
                  return '<img src="' + data + '" class="rounded-circle" width="35" data-toggle="tooltip" />';
             }
            },
            {data: 'status_akun'},
            {data: 'aktivitas'},
            { data: null, className: "text-center", mRender: function(data, type, full) {
              if(data.level == 1) {
                return '<span class="badge badge-success">superadmin</span>';
            }
            if(data.level == 2) {
                return '<span class="badge badge-info">pembina</span>';
            }
            if(data.level == 3) {
                return '<span class="badge badge-warning">alumni</span>';
            }
            if(data.level == 4) {
                return '<span class="badge badge-danger">siswa</span>';
            }
            }},
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
        $('#modal-form .modal-title').text('Tambah Users');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=name]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Users');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=name]').val('put');
        $('#modal-form [name=name]').focus();

        $('#password, #password_confirmation').attr('required', false);

        $.get(url)
        .done((response) => {
            $('#modal-form [name=name]').val(response.name);
            $('#modal-form [name=status_akun]').val(response.status_akun);
            $('#modal-form [name=level]').val(response.level);

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
