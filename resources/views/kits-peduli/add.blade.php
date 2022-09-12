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
							<h4>KITS PEDULI</h4>
						</div>
						<form action="{{ route('kits-peduli.store')}}" method="POST">
						{{-- @csrf --}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card-body">
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Masukan Nominal</label>
								<div class="col-sm-12 col-md-7">
									<input type="number" class="form-control" name="nominal" id="nominal" placeholder="Masukan Nominal" required="">
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Metode Pembayaran</label>
								<div class="col-sm-12 col-md-7">
									@foreach ($metode as $m)
									{{-- @if($m->active) --}}
									<div class="form-check">
										<input class="form-check-input" type="radio" name="metode"  value="{{$m->code}}">
										<label class="form-check-label">
											{{$m->name}}
										</label>
									</div>
									{{-- @endif --}}
									@endforeach
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
								<div class="col-sm-12 col-md-7">
									<a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
									<button type="submit" class="btn btn-primary">Donasi Sekarang</button>
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