@extends('layouts.backend')

@section('content')

    <div class="col-md">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
            </div>
        
            <div class="card-body">
                
                <form action="/kecamatan/update/{{ $kecamatan->id_kecamatan }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Kecamatan" value="{{ old('kecamatan', $kecamatan->kecamatan) }}">
                                <div class="text-danger ml-3">
                                    @error('kecamatan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Warna</label>
                            <div class="input-group my-colorpicker2">
                                <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" placeholder="Warna" value="{{ old('warna', $kecamatan->warna) }}">

                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            
                            </div>
                            <div class="text-danger ml-3">
                                @error('warna')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm">
                            <label id="geojson">GEOJSON</label>
                            <textarea name="geojson" id="geojson" rows="5" class="form-control @error('geojson') is-invalid @enderror" placeholder="GeoJSON">{{ old('geojson', $kecamatan->geojson) }}</textarea>
                            <div class="text-danger ml-3">
                                @error('geojson')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-flat">Simpan</button>
                        <a href="/kecamatan" class="btn btn-danger btn-flat">Kembali</a>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- bootstrap color picker -->
    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <script>
        //color picker with addon
        $('.my-colorpicker2').colorpicker();

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

    </script>

@endsection


