@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Kandidat</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">Tambah</a></div>
				<div class="breadcrumb-item">kandidat</div>
			</div>
		</div>

    <div class="section-body">
      <h2 class="section-title">Kandidat Baru</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Kandidat Baru</h4>
            </div>
            <form action="{{ route('candidate.store')}}" id="modal-form" method="POST" enctype="multipart/form-data">
            {{-- @csrf --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="nama_ketua" id="nama_ketua" class="form-control" required="">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Visi</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="visi" id="visi" class="form-control" required="">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Misi</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="misi" id="misi" class="form-control" required="">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Program Kerja</label>
                <div class="col-sm-12 col-md-7">
                 <textarea name="program_kerja" id="program_kerja" class="summernote" required=""></textarea>
               </div>
             </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
              <div class="col-sm-12 col-md-7">
                <input type="file" name="photo_paslon" class="form-control" id="photo_paslon" required="">
                   <div class="form-text text-muted">The file must have a maximum size of 2MB (PDF, JPG, PNG)</div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button type="submit" class="btn btn-primary">Tambah</button>
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