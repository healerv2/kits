@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Voting</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">voting</a></div>
                <div class="breadcrumb-item">kandidat</div>
            </div>
        </div>
        <div class="section-body">
            @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            @if(Auth::user()->status_voting == "BELUM")
            <form enctype="multipart/form-data" action="{{route('users.vote',['id'=>Auth::user()->id])}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT" class="form-control">
                <div class="row">
                    @foreach ($candidate as $c)
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Nomor Urut: {{ $loop->iteration }} </h4>
                            </div>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <img src="{{ url($c->photo_paslon ?? '/') }}" width="200" height="200" alt="image">
                                    <h2>{{$c->nama_ketua}}</h2>
                                    <p class="lead">
                                        <p>Visi : {{$c->visi}}</p>
                                        <div class="form-group" align="center">
                                            <button name="kandidat_id" value="{{$c->id}}" class="btn btn-primary">PILIH</button>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
            @else 
            <h1 align="center">SUDAH MEMILIH</h1>
            @endif
        </div>
    </section>
</div>
@stop
@push('scripts')
<script>
  $('.alert').fadeIn();
  setTimeout(() => {
    $('.alert').fadeOut();
}, 3000);
</script>
@endpush