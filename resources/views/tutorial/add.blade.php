@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Tutorial</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">tutorial</a></div>
				<div class="breadcrumb-item">add</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Tutorial</h2>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Tambah Tutorial</h4>
						</div>
						<form action="{{ route('tutorials.store')}}" method="POST" enctype="multipart/form-data">
						{{-- @csrf --}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card-body">
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tutorial</label>
								<div class="col-sm-12 col-md-7">
									<input type="text" class="form-control" name="name_tutorial" id="name_tutorial" placeholder="Nama Tutorial" required="">
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori Tutorial</label>
								<div class="col-sm-12 col-md-7">
									<select class="form-control" name="kategori_id" id="kategori_id">
										<option value="">Pilih Kategori</option>
										@foreach($kategori as $value)
										<option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload</label>
								<div class="col-sm-12 col-md-7">
									 <input type="file" name="file" class="form-control" id="file">
									 <div class="form-text text-muted">The file must have a maximum size of 2MB</div>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
								<div class="col-sm-12 col-md-7">
									<a href="{{ route('tutorials.index') }}" class="btn btn-danger">Cancel</a>
									<button type="submit" class="btn btn-primary">Publish</button>
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