@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Rekapitulasi Suara</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Rekapitulasi</a></div>
                <div class="breadcrumb-item">Suara</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rekapitulasi Suara</h4>
                            <a href="{{ route('voting.pdf') }}" class="btn btn-lg btn-success" target="_blank">Export PDF</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                    <tr>
                                        <th>Nomor Urut</th>
                                        <th>Foto Kandidat</th>
                                        <th>Nama Kandidat</th>
                                        <th>Jumlah Suara</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @foreach ($candidates as $candidate)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($candidate->photo_paslon)
                                            <img src=" {{ $candidate->photo_paslon }}" width="100px"/>
                                            @endif
                                        </td>
                                        <td>{{$candidate->nama_ketua}}</td>
                                        <td>{{$candidate->user->count()}} Suara</td>
                                        <td>@if($candidate->user->count() ) 
                                            {{number_format (($candidate->user->count()/$jumlah)*100)}}  %
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tfoot>
                                    <tr>
                                        <td colspan=10>
                                            {{$candidates->appends(Request::all())->links()}}
                                        </td>
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@stop