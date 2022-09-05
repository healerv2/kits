@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Profile</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item">Profile</div>
			</div>
		</div>
		<div class="section-body">
			<h2 class="section-title">Hi, {{ Auth::user()->name }} !</h2>
			<p class="section-lead">
				Change information about yourself on this page.
			</p>

			<div class="row mt-sm-4">
				<div class="col-12 col-md-6 col-lg-5">
					<div class="card profile-widget">
						<div class="profile-widget-header">                     
							<img alt="image" src="{{ url($profil->foto ?? '/') }}" class="rounded-circle profile-widget-picture">
							<div class="profile-widget-items">
								<div class="profile-widget-item">
									<div class="profile-widget-item-label">Level Akun</div>
									@if (auth()->user()->level == 1)
									<div class="profile-widget-item-value">Superadmin</div>
									@elseif (auth()->user()->level == 2)
									<div class="profile-widget-item-value">Pembina</div>
									@elseif (auth()->user()->level == 3)
									<div class="profile-widget-item-value">Alumni</div>
									@else
									<div class="profile-widget-item-value">Siswa</div>
									@endif
								</div>
								<div class="profile-widget-item">
									<div class="profile-widget-item-label">Phone (WA) </div>
									<div class="profile-widget-item-value">{{ Auth::user()->phone }}</div>
								</div>
							</div>
						</div>
						<div class="profile-widget-description">
							<div class="profile-widget-name">{{ Auth::user()->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>{{ Auth::user()->aktivitas }} </div></div>
							{!!html_entity_decode(Auth::user()->bio)!!}
						</div>
						<div class="card-footer text-center">
							<div class="font-weight-bold mb-2">Follow {{ Auth::user()->name }} On</div>
							<a href="#" target="_blank" class="btn btn-social-icon btn-facebook mr-1">
								<i class="fab fa-facebook-f"></i>
							</a>
							<a href="#" target="_blank" class="btn btn-social-icon btn-twitter mr-1">
								<i class="fab fa-twitter"></i>
							</a>
							<a href="#" target="_blank" class="btn btn-social-icon btn-github mr-1">
								<i class="fab fa-github"></i>
							</a>
							<a href="#" target="_blank" class="btn btn-social-icon btn-instagram">
								<i class="fab fa-instagram"></i>
							</a>
						</div>
					</div>
					<form action="{{ route('users.change-password') }}" method="post">
						@csrf 
						<div class="card">
							<div class="card-header">
								<h4>Ganti Password</h4>
							</div>
							<div class="card-body">
								@foreach ($errors->all() as $error)
								<div class="alert alert-danger">
									{{ $error }}
								</div>
								@endforeach 
								@if(session()->has('message'))
								<div class="alert alert-success">
									<div>{{ session()->get('message') }}</div>
								</div>
								@endif
								<div class="form-group">
									<div class="d-block">
										<label for="old_password" class="control-label">Password Lama</label>
									</div>
									<input type="password" name="old_password" id="old_password" class="form-control" tabindex="2" required>
									<div class="invalid-feedback">
										Please fill in your password
									</div>
								</div>
								<div class="form-group">
									<div class="d-block">
										<label for="password" class="control-label">Password Baru</label>
									</div>
									<input type="password" name="password" id="password" class="form-control" tabindex="2" required>
									<div class="invalid-feedback">
										Please fill in your password
									</div>
								</div>
								<div class="form-group">
									<div class="d-block">
										<label for="password_confirmation" class="control-label">Konfrimasi Password</label>
									</div>
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" tabindex="2"  data-match="#password">
									<div class="invalid-feedback">
										Please fill in your password
									</div>
								</div>
								<div class="card-footer text-right">
									<button class="btn btn-primary"> Update Password </button>
								</div>
							</div>
						</div>
					</form>
					<div class="card">
						<div class="card-header">
							<h4>Two Factor Authentication (2FA)</h4>
						</div>
						<div class="card-body">
							@if(session('status') =="two-factor-authentication-disabled")
							<div class="alert alert-danger">
								Two Factor Authentication  Has Been Disabled
							</div>
							@endif
							@if(session('status') =="two-factor-authentication-enabled")
							<div class="alert alert-success">
								Two Factor Authentication  Has Been enabled
							</div>
							@endif
							<form action="/user/two-factor-authentication" method="post">
								@csrf 
								@if (auth()->user()->two_factor_secret)
								@method('DELETE')
								<div>
									{!! auth()->user()->twoFactorQrCodeSvg()!!}
								</div>
								<p></p>
									<p>Recovery Code 2FA</p>
									<ul>
										@foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
										<li>{{ $code }}</li>
										@endforeach
									</ul>
								<p></p>
								<button class="btn btn-danger">Disable</button>
								@else
								<button class="btn btn-primary">Enable</button>
								@endif
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-7">
					<div class="card">
						<form action="{{ route('users.update_profil') }}" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data">
							@csrf 
							<div class="card-header">
								<h4>Edit Profile</h4>
							</div>
							<div class="alert alert-info alert-dismissible" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="icon fa fa-check"></i> Perubahan berhasil disimpan
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-12 col-12">
										<label>Foto</label>
										<input type="file" name="foto" class="form-control" id="foto"
										onchange="preview('.tampil-foto', this.files[0])">
										<div class="invalid-feedback">
											Please fill in the first name
										</div>
										<div class="tampil-foto">
											<img src="{{ url($profil->foto ?? '/') }}" width="200">
										</div>
									</div>                               
									<div class="form-group col-md-12 col-12">
										<label>Full Name</label>
										<input type="text" class="form-control" name="name" id="name" value="{{ $profil->name }}" required="">
										<div class="invalid-feedback">
											Please fill in the first name
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6 col-12">
										<label>Email</label>
										<input type="email" class="form-control" name="email" id="email" value="{{ $profil->email }}" required="">
										<div class="invalid-feedback">
											Please fill in the email
										</div>
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Phone</label>
										<input type="text" class="form-control" name="phone" id="phone" value="{{ $profil->phone }}">
									</div>
									<div class="form-group col-md-6 col-12">
										<label>Angkatan</label>
										<select class="form-control" name="angkatan_id" id="angkatan_id" required>
											<option>==Pilih Angkatan==</option>
											@foreach($angkatan as $value)
											<option value="{{ $value->id }}" {{ $value->id == $profil->angkatan_id ? 'selected' : '' }}>{{ $value->nama_angkatan }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Status</label>
										<select class="form-control select2" name="status" id="status">
											<option>==Pilih Status==</option>
											<option name="Menikah" {{ $profil->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
											<option name="Lajang" {{ $profil->status == 'Lajang' ? 'selected' : '' }}>Lajang</option>
										</select>
										{{-- <input type="text" class="form-control" name="status" id="status" value="{{ $profil->status }}"> --}}
									</div>
									<div class="form-group col-md-6 col-12">
										<label>Tahun Lulus</label>
										<input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" value="{{ $profil->tahun_lulus }}" required="">
										<p>Contoh : 2015</p>
										<div class="invalid-feedback">
											Please fill in the email
										</div>
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Aktivitas</label>
										<select class="form-control select2" name="aktivitas" id="aktivitas">
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
										<textarea type="text" class="form-control" name="detail_alamat" id="detail_alamat">{{ $profil->detail_alamat }}</textarea>
										<div class="invalid-feedback">
											Please fill in the email
										</div>
									</div>
									<div class="form-group col-md-12 col-12">
										<label>Detail Aktivitas</label>
										<input type="text" class="form-control" name="detail_aktivitas" id="detail_aktivitas" value="{{ $profil->detail_aktivitas }}" required="">
										<p> Contoh : Bekerja di PT. A sebagai Jr. Web Developer / Kuliah di UB Jurusan TI/DKV/Adm. Bisnis</p>
										<div class="invalid-feedback">
											Please fill in the first name
										</div>
									</div>
									<div class="form-group col-12">
										<label>Bio</label>
										<textarea name="bio" id="bio" class="form-control" rows="3">
											{{ $profil->bio }}
										</textarea>
									</div>
								</div>
							</div>
							<div class="card-footer text-right">
								<button class="btn btn-primary"> Update Data Profil
                        </button>
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
	$(function () {
		// $('.form-password').validator().on('submit', function (e) {
		// 	if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
		// 	else $('#password, #password_confirmation').attr('required', false);
		// });

		$('.form-profil').validator().on('submit', function (e) {
			if (! e.preventDefault()) {
				$.ajax({
					url: $('.form-profil').attr('action'),
					type: $('.form-profil').attr('method'),
					data: new FormData($('.form-profil')[0]),
					async: false,
					processData: false,
					contentType: false
				})
				.done(response => {
					$('[name=name]').val(response.name);
					$('.tampil-foto').html(`<img src="{{ url('/') }}${response.foto}" width="200">`);
					$('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);

					$('.alert').fadeIn();
					setTimeout(() => {
						$('.alert').fadeOut();
					}, 3000);
				})
				.fail(errors => {
					if (errors.status == 422) {
						alert(errors.responseJSON); 
					} else {
						alert('Tidak dapat menyimpan data');
					}
					return;
				});
			}
		});
	});
</script>
@endpush