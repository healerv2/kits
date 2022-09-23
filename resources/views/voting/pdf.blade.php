<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
    </style>
    <center>
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Rekapitulasi Suara</h4>
                                    <h5>Pemilihan Ketua & Wakil Ketua Komunitas IT SMKN 1 Nglegok {{$setting->periode}}</h5>
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
                                                    <td><img src="{{public_path($candidate->photo_paslon)}}"width="100px"/></td>
                                                    {{-- <td><img src="{{ public_path("kandidat/".$candidate->photo_paslon) }}" alt="" width="100px"/></td> --}}
                                                    <td>{{$candidate->nama_ketua}}</td>
                                                    <td>{{$candidate->user->count()}} Suara</td>
                                                    <td>@if($candidate->user->count(0) )
                                                        {{number_format (($candidate->user->count()/$jumlah)*100)}} %
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
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
    </body>
    </html>