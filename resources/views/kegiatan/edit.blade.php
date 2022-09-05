@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Layanan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">layanan</a></div>
				<div class="breadcrumb-item">edit</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Layanan</h2>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Edit Layanan</h4>
						</div>
						<form action="{{ route('layanan.update',$layanan->id)}}" method="POST">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Layanan</label>
								<div class="col-sm-12 col-md-7">
									<input type="text" class="form-control" name="kode_layanan" id="kode_layanan" value="{{$layanan->kode_layanan}}" placeholder="Kode" required>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Layanan</label>
								<div class="col-sm-12 col-md-7">
									<input type="text" class="form-control" name="nama_layanan" id="nama_layanan" value="{{$layanan->nama_layanan}}" placeholder="Nama Layanan" required>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
								<div class="col-sm-12 col-md-7">
									<input type="number" class="form-control" name="harga_layanan" id="harga_layanan" value="{{$layanan->harga_layanan}}" placeholder="Harga" required>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Fasilitas 
								</label>
								<div class="col-sm-12 col-md-7">
									<textarea type="text" class="summernote" name="fasilitas_layanan" id="fasilitas_layanan">{{$layanan->fasilitas_layanan}}</textarea>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Diskripsi</label>
								<div class="col-sm-12 col-md-7">
									<input type="text" class="form-control" name="note_layanan" id="note_layanan" value="{{$layanan->note_layanan}}" placeholder="Note" required>
								</div>
							</div>
							<div class="form-group row mb-4">
								<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
								<div class="col-sm-12 col-md-7">
									<a href="{{ route('layanan.index') }}" class="btn btn-danger">Cancel</a>
									<button type="submit" class="btn btn-primary">Update</button>
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