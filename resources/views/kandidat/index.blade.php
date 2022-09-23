@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Kandidat</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">data</a></div>
              <div class="breadcrumb-item">kandidat</div>
          </div>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <h4>Daftar Kandidat Calon Ketua dan Wakil</h4>
                        </div>
                        <a href="{{ route('candidate.create') }}" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah Kandidat</a>
                    </div>
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <div>{{ session()->get('message') }}</div>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nama</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Photo Kandidat</th>
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
                url: '{{ route('candidate.data') }}',
            },
            columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_ketua'},
            {data: 'visi'},
            {data: 'misi'},
            {data: 'photo_paslon', 
            render: function (data, type, full, meta) {
              return '<img src="' + data + '" class="rounded-circle" width="50" data-toggle="tooltip" />';
          }
      },
      {data: 'aksi', searchable: false, sortable: false},
      ]
  });

});

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
<script>
  $('.alert').fadeIn();
  setTimeout(() => {
    $('.alert').fadeOut();
  }, 3000);
</script>
@endpush
