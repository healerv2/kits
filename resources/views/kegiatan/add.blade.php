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
      <h2 class="section-title">Kegiatan Baru</h2>
      <p class="section-lead">
        On this page you can create a new post and fill in all fields.
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Kegiatan Baru</h4>
            </div>
            <form action="{{ route('kegiatans.store')}}" method="POST" enctype="multipart/form-data">
            {{-- @csrf --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kegiatan</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="name_kegiatan" id="name_kegiatan" class="form-control" required="">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Kegiatan</label>
                <div class="col-sm-12 col-md-7">
                   <input type="text" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control datepicker" required="">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail Kegitan</label>
                <div class="col-sm-12 col-md-7">
                 <textarea name="detail_kegiatan" id="detail_kegiatan" class="summernote-simple" required=""></textarea>
               </div>
             </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File Surat / Poster Kegiatan</label>
              <div class="col-sm-12 col-md-7">
                <input type="file" name="file" class="form-control" id="file" required="">
                   <div class="form-text text-muted">The file must have a maximum size of 2MB (PDF, JPG, PNG)</div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button type="submit" class="btn btn-primary">Create Post</button>
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