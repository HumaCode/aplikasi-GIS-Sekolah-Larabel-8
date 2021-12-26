@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>{{ $kecamatan }}</h3>

                    <p>Kecamatan</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-cloud"></i>
                    </div>
                    <a href="/kecamatan" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3>{{ $jenjang }}</h3>

                    <p>Jenjang</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-cubes"></i>
                    </div>
                    <a href="/jenjang" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $sekolah }}</h3>

                    <p>Sekolah</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-school"></i>
                    </div>
                    <a href="/sekolah" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>{{ $user }}</h3>

                    <p>Users</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-user"></i>
                    </div>
                    <a href="/user" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
    </div>
</div>
@endsection
