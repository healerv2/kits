@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Dashboard</h1>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-primary">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Total Alumni</h4>
						</div>
						<div class="card-body">
							{{$total_alumni}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-danger">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Total Siswa</h4>
						</div>
						<div class="card-body">
							{{$total_siswa}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-warning">
						<i class="far fa-file"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Tutorial</h4>
						</div>
						<div class="card-body">
							{{$tutorial_approved}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-success">
						<i class="fas fa-heart"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>KITS Peduli</h4>
						</div>
						<div class="card-body">
						{{ format_uang($kitspeduli) }}
						</div>
					</div>
				</div>
			</div>                  
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-12 col-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Statistics Alumni Tahun Lulus</h4>
					</div>
					<div class="card-body">
						<canvas id="TahunLulusChart" height="182"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>New Users</h4>
					</div>
					<div class="card-body">             
						<ul class="list-unstyled list-unstyled-border">
							@forelse ($users as $user)
							<li class="media">
								<img class="mr-3 rounded-circle" width="50" src="{{ $user->foto }}" alt="avatar">
								<div class="media-body">
									<div class="float-right text-primary">{{ $user->status_akun }}</div>
									<div class="media-title">{{ $user->name }}</div>
									<span class="text-small text-muted">{{ $user->email }}</span>
								</div>
							</li>
							@empty
							<div class="alert alert-danger">
								Data Post belum Tersedia.
							</div>
							@endforelse
						</ul>
						<div class="text-center pt-1 pb-1">
							<a href="{{ route('users.index') }}" class="btn btn-primary btn-lg btn-round">
								View All
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Statistics Aktivikas Alumni</h4>
					</div>
					<div class="card-body">
						<canvas id="AktifitasAlumniChart" height="182"></canvas>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@stop
@push('scripts')
<script>
	var ctx = document.getElementById('TahunLulusChart').getContext('2d');
	var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
data: {
	labels:  {!!json_encode($chart_tahun_lulus->labels)!!} ,
	datasets: [
	{
		label: 'Tahun Lulus ',
		backgroundColor: {!! json_encode($chart_tahun_lulus->colours)!!} ,
		backgroundColor: '#63ed7a',
		borderColor: '#63ed7a',
		data:  {!! json_encode($chart_tahun_lulus->dataset)!!} ,
	},
	]
},
// Configuration options go here
options: {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero: true,
				callback: function(value) {if (value % 1 === 0) {return value;}}
			},
			scaleLabel: {
				display: false
			}
		}]
	},
	legend: {
		labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
            	padding: {
            		left: 10,
            		right: 10,
            		top: 0,
            		bottom: 10
            	}
            }
        }
    });
</script>
<script>
	var ctx = document.getElementById('AktifitasAlumniChart').getContext('2d');
	var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
data: {
	labels:  {!!json_encode($chart_aktivitas_alumni->labels)!!} ,
	datasets: [
	{
		label: 'Aktivitas ',
		backgroundColor: '#6777ef',
		borderColor: '#6777ef',
		data:  {!! json_encode($chart_aktivitas_alumni->dataset)!!} ,
	},
	]
},
// Configuration options go here
options: {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero: true,
				callback: function(value) {if (value % 1 === 0) {return value;}}
			},
			scaleLabel: {
				display: false
			}
		}]
	},
	legend: {
		labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
            	padding: {
            		left: 10,
            		right: 10,
            		top: 0,
            		bottom: 10
            	}
            }
        }
    });
</script>
@endpush