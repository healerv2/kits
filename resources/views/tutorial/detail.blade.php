@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Tutorial</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">tutorial</a></div>
				<div class="breadcrumb-item">details</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Tutorial</h2>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Detail Tutorial</h4>
						</div>
						<form action="#" method="POST" enctype="multipart/form-data">
							{{-- @csrf --}}
							{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
							<div class="card-body">
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tutorial</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" class="form-control" name="name_tutorial" id="name_tutorial" placeholder="Nama Tutorial" value="{{ $tutorial->name_tutorial }}" readonly>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" class="form-control" name="name_tutorial" id="name_tutorial" placeholder="Nama Tutorial" value="{{ $tutorial->user->name }}" readonly>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" class="form-control" name="name_tutorial" id="name_tutorial" placeholder="Nama Tutorial" value="{{ $tutorial->kategori->nama_kategori }}" readonly>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File </label>
									<div class="col-sm-12 col-md-7">
										<iframe src="{{ url('tutorial/' . $tutorial->file) }}" align="top" height="620" width="100%" frameborder="0" scrolling="auto"></iframe>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
									<div class="col-sm-12 col-md-7">
										<a href="{{ route('tutorials.index') }}" class="btn btn-danger">Kembali</a>
										{{-- <button type="submit" class="btn btn-primary">Publish</button> --}}
										{{-- <div class="btn btn-primary"> --}}
											<select class="btn btn btn-primary" id="update_status" name="status">
												<option selected disabled>Update Status</option>
												<option value="1">reviewed</option>
												<option value="2">reject</option>
												<option value="3">revision</option>
												<option value="4">approved</option>
											</select>
										{{-- </div> --}}
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@stop
@push('scripts')
  <script>
   $(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#update_status').on('change', function(e){
     var status = $(this).find(":selected").attr("value");

     $.ajax({
      url: '{{url('/tutorials/status')}}',
      data: { _token: CSRF_TOKEN, id: {{ Request::segment(3) }}, status: status},
      dataType: "json",
      type: "POST",
      success: function (response) {
        if(response.success){
          return toastr.success(response.message, 'Sukses !')
        }
        return toastr.error(response.message, 'Gagal !')
      },
      error: function (response) {
        console.log(response)
        toastr.error("Gagal, terjadi kesalahan server")
      }
    });
   });


    
  });
</script>
@endpush