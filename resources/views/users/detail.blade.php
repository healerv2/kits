@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Detail Users</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item">Detail</div>
			</div>
		</div>
		<div class="section-body">
			<div class="row mt-sm-4">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4> Detail Profile</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="form-group col-md-12 col-12">
									<div class="tampil-foto" align="center">
										<img src="{{ url($profil->foto ?? '/') }}" width="200">
									</div>
								</div>
								<div class="form-group col-md-12 col-12">
									<label>Full Name</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ $profil->name }}" readonly>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6 col-12">
									<label>Email</label>
									<input type="email" class="form-control" name="email" id="email" value="{{ $profil->email }}" readonly>
								</div>
								<div class="form-group col-md-5 col-12">
									<label>Phone</label>
									<input type="text" class="form-control" name="phone" id="phone" value="{{ hide_mobile_no($profil->phone)}}" readonly>
								</div>
								<div class="form-group col-md-6 col-12">
									<label>Angkatan</label>
									<select class="form-control" name="angkatan_id" id="angkatan_id" disabled>
										<option>==Pilih Angkatan==</option>
										@foreach($angkatan as $value)
										<option value="{{ $value->id }}" {{ $value->id == $profil->angkatan_id ? 'selected' : '' }} >{{ $value->nama_angkatan }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-5 col-12">
									<label>Status</label>
									<select class="form-control select2" name="status" id="status" disabled>
										<option>==Pilih Status==</option>
										<option name="Menikah" {{ $profil->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
										<option name="Lajang" {{ $profil->status == 'Lajang' ? 'selected' : '' }}>Lajang</option>
										</select>
									</div>
									<div class="form-group col-md-6 col-12">
										<label>Tahun Lulus</label>
										<input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" value="{{ $profil->tahun_lulus }}" readonly>
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Aktivitas</label>
										<select class="form-control select2" name="aktivitas" id="aktivitas" disabled>
											<option>==Pilih Aktivitas==</option>
											<option name="Bekerja" {{ $profil->aktivitas == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
											<option name="Wirausaha" {{ $profil->aktivitas == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
											<option name="Kuliah" {{ $profil->aktivitas == 'Kuliah' ? 'selected' : '' }}>Kuliah</option>
											<option name="Siswa" {{ $profil->aktivitas == 'Siswa' ? 'selected' : '' }}>Siswa</option>
											<option name="Other" {{ $profil->aktivitas == 'Other' ? 'selected' : '' }}>Other</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-12">
										<label>Detail Alamat</label>
										<textarea type="text" class="form-control" name="detail_alamat" id="detail_alamat" readonly>{{ $profil->detail_alamat }}</textarea>
									</div>
									<div class="form-group col-md-12 col-12">
										<label>Detail Aktivitas</label>
										<input type="text" class="form-control" name="detail_aktivitas" id="detail_aktivitas" value="{{ $profil->detail_aktivitas }}" readonly>
									</div>
									<div class="form-group col-12">
										<label>Bio</label>
										<textarea type="text"  class="form-control"  readonly>
											{!! ($profil->bio) !!}
										</textarea>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@stop