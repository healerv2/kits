@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Kandidat</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">edit </a></div>
				<div class="breadcrumb-item">kandidat</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Edit Kandidat</h2>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4> Edit Kandidat</h4>
						</div>
						<form enctype="multipart/form-data" action="{{ route('candidate.update',$kandidat->id)}}" method="POST">
							@csrf
							@method('PUT')
							{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
							<div class="card-body">
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" name="nama_ketua" id="nama_ketua" class="form-control" value="{{$kandidat->nama_ketua}}" required="">
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Visi</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" name="visi" id="visi" class="form-control" value="{{$kandidat->visi}}" required="">
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Misi</label>
									<div class="col-sm-12 col-md-7">
										<input type="text" name="misi" id="misi" class="form-control" value="{{$kandidat->misi}}" required="">
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Program Kerja</label>
									<div class="col-sm-12 col-md-7">
										<textarea name="program_kerja" id="program_kerja" class="summernote"  required="">{{$kandidat->program_kerja}}</textarea>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
									<div class="col-sm-12 col-md-7">
										@if ($kandidat->photo_paslon)
										<img src="{{($kandidat->photo_paslon)}}" width="150px"/>
										@else
										No Cover
										@endif
										<p></p>
										<input type="file" name="photo_paslon" class="form-control" id="photo_paslon" required="">
										<div class="form-text text-muted">The file must have a maximum size of 2MB (PDF, JPG, PNG)</div>
									</div>
								</div>
								<div class="form-group row mb-4">
									<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
									<div class="col-sm-12 col-md-7">
										<button type="submit" class="btn btn-primary">Update</button>
										<a href="{{ route('candidate.index') }}" class="btn btn-danger">Batal</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop