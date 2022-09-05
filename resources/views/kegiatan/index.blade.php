@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kegiatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kegiatan</a></div>
                <div class="breadcrumb-item">KITS</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Kegiatan KITS</h2>
            <p class="section-lead">Kegiatan KITS meliputi kegiatan formal dan infromal.</p>
            <form class="form" method="get" action="{{ route('kegiatans.search') }}">
                <div class="form-group w-100 mb-3">
                    <label for="search" class="d-block mr-2">Pencarian</label>
                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                    <button type="submit" class="btn btn-primary mb-1">Cari</button>
                </div>
            </form>
            <br>
            @if(session()->has('message'))
            <div class="alert alert-success">
                <div>{{ session()->get('message') }}</div>
            </div>
            @endif
            <div class="row">
                @forelse ($kegiatan as $kegiatans)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="{{url('')}}/assets/img/news/img08.jpg"></div>
                            <div class="article-title">
                                <h2><a href="{{url('')}}/kegiatans/detail/{{ $kegiatans->slug }}">{{$kegiatans->name_kegiatan}}</a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <p>{!! Str::words($kegiatans->detail_kegiatan, 30, ' ...') !!}</p>
                            <div class="article-cta">
                                <a href="{{url('')}}/kegiatans/detail/{{ $kegiatans->slug }}" class="btn btn-primary">Detail Kegiatan</a>
                            </div>
                            <p></p>
                            <div class="text-job" align="center">{{tanggal_indonesia($kegiatans->tanggal_kegiatan,false)}}</div>
                        </div>

                    </article>
                </div>
                @empty
                <a href="{{ route('kegiatans.index') }}" class="btn btn-danger btn-xs btn-flat"> Data Kegiatan belum Tersedia. Back bestie!</a>
                @endforelse
            </div>
            {{ $kegiatan->links() }}
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
