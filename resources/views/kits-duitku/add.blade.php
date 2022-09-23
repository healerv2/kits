@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>KITS Peduli</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">tutorial</a></div>
				<div class="breadcrumb-item">kits-peduli</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">KITS Peduli</h2>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>KITS PEDULI DUITKU CHANNELS</h4>
						</div>
						<form action="{{ route('kits-berbagi.payment') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Masukan Nominal</label>
								<div class="col-sm-12 col-md-7">
									<input type="number" class="form-control" name="nominal" id="nominal" placeholder="Masukan Nominal" required="">
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
								<div class="col-sm-12 col-md-7">
									<button type="submit" class="btn btn-primary">Donasi Sekarang</button>
									<a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
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