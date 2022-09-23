@extends('layouts.index')
@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Pembayaran</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">payment</a></div>
				<div class="breadcrumb-item">method</div>
			</div>
		</div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Metode Pembayaran</h4>
            </div>
            <form action="{{ route('kits-berbagi.postpayment')}}" method="POST">
              @csrf
              <input type="hidden" value="{{ $transaksi->id }}" name="id">
              <div class="card-body">
              {{-- <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="name_kegiatan" id="name_kegiatan" class="form-control" value="{{$transaksi->nama}}" readonly>
                </div>
              </div>
               <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="name_kegiatan" id="name_kegiatan" class="form-control" value="{{$transaksi->email}}" readonly>
                </div>
              </div>
               <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="name_kegiatan" id="name_kegiatan" class="form-control" value="{{$transaksi->nohp}}" readonly>
                </div>
              </div> --}}
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Metode Pembayaran</label>
                <div class="col-sm-12 col-md-7">
                  @foreach($methods as $key => $method)
                  <div class="form-check">
                   <input class="form-check-input" type="radio" name="payment_method" id="payment_method_{{$key}}" value="{{ $method['code'] }}">
                   <label for="payment_method_{{$key}}">
                    <img class="form-check-label" src="{{ $method['image'] }}" height="60" alt="{{ $method['name'] }}">
                    <p>{{ $method['name'] }}</p>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
               <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
               <a href="{{ route('dashboard') }}" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i>Cancel</a>
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