@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemilih</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">Pemilih</div>
          </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                            <h4>List Status Pemilih</h4>
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
                                            <th>Foto</th>
                                            <th>Status Voting</th>
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
                url: '{{ route('voter.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'name'},
            {data: 'email'},
            {data: 'foto', 
                render: function (data, type, full, meta) {
                  return '<img src="' + data + '" class="rounded-circle" width="35" data-toggle="tooltip" />';
             }
            },
            { data: null, className: "text-center", mRender: function(data, type, full) {
              if(data.status_voting == "SUDAH") {
                return '<span class="badge badge-success">SUDAH</span>';
            }
            if(data.status_voting == "BELUM") {
                return '<span class="badge badge-danger">BELUM</span>';
            }
            }},
            ]
        });
    });
</script>
@endpush
