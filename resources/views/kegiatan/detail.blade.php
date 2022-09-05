@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Kegiatan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">kegiatan</a></div>
				<div class="breadcrumb-item">details</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{$kegiatan->name_kegiatan}}</h2>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4>Tanggal Kegiatan : {{tanggal_indonesia($kegiatan->tanggal_kegiatan,false)}}</h4>
						</div>
						<div class="card-body">
							<div class="ticket-content">
								<div class="ticket-header">
									<div class="ticket-detail">
										<div class="ticket-title">
											<h4>{{$kegiatan->name_kegiatan}}</h4>
										</div>
									</div>
								</div>
								<div class="ticket-description">
									<p>{!! ($kegiatan->detail_kegiatan) !!}</p>

									<div class="ticket-divider"></div>

									<div class="ticket-form">
										<iframe src="{{ url('kegiatan/' . $kegiatan->file) }}" align="top" height="620" width="100%" frameborder="0" scrolling="auto"></iframe>
									</div>
								</div>
								<br>
								<div class="form-group text-right">
									<a href="{{ route('kegiatans.index') }}" class="btn btn-danger">Kembali</a>
								</div>
							</div>
						</div>
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