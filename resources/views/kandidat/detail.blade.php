@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Detail Kandidat</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item">Detail Kandidat</div>
			</div>
		</div>

		<div class="section-body">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="tickets">
								<div class="ticket-content">
									<div class="ticket-header">
										<div class="ticket-sender-picture img-shadow">
											<img src="{{ url($kandidat->photo_paslon ?? '/') }}" alt="image">
										</div>
										<div class="ticket-detail">
											<div class="ticket-title">
												<h3>{{$kandidat->nama_ketua}}</h3>
											</div>
											<div class="ticket-info">
												<h6>Visi	: {{$kandidat->visi}}</h6>
											</div>
											<div class="ticket-info">
												<h6>Misi	: {{$kandidat->misi}}</h6>
											</div>
										</div>
									</div>
									<div class="ticket-description">
										<h6>Progam Kerja Kandidat :</h6>
										<p>{!!html_entity_decode($kandidat->program_kerja)!!}</p>

									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<a href="{{ route('candidate.index') }}" class="btn btn-danger">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@stop