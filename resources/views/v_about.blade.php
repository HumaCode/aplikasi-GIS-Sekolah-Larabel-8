@extends('layouts.frontend')

@section('container')
    <div class="row">
        <div class="col-md">

        <!-- Profile Image -->
        <div class="card card-primary card-outline" style="background-image: url('{{ asset('foto/bg.png') }}')">
            <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ asset('foto/saya.jpg') }}"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">Humaidi Zakaria</h3>

            <p class="text-muted text-center">Project UAS PBO WEB | Fakultas Teknik dan Ilmu Komputer</p>

            <hr>
            <p>Aplikasi GIS Sekolah adalah aplikasi untuk melihat data sekolah di kabupaten pekalongan dalam bentuk peta geografis, baik jenjang TK, SD, SMP/MTs maupun SMK/SMA dan masih bisa di tambahkan lagi.</p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
    </div>
@endsection