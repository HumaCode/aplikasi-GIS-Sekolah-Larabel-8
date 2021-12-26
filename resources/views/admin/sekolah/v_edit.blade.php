@extends('layouts.backend')

@section('content')

    <div class="col-md">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
            </div>
        
            <div class="card-body">
                
                <form action="/sekolah/update/{{ $sekolah->id_sekolah }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}">
                                <div class="text-danger ml-3">
                                    @error('nama_sekolah')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenjang</label>
                                <select name="id_jenjang" id="id_jenjang" class="form-control @error('id_jenjang') is-invalid @enderror" >
                                    @foreach ($jenjang as $item)
                                        @if ($item->id_jenjang == $sekolah->id_jenjang)
                                            <option value="{{ $item->id_jenjang }}" selected>{{ $item->jenjang }}</option>
                                        @else
                                        <option value="{{ $item->id_jenjang }}">{{ $item->jenjang }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="text-danger ml-3">
                                    @error('id_jenjang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status Sekolah</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" >
                                    @foreach ($status as $item)
                                        @if ($item == $sekolah->status)
                                            <option value="{{ $item }}"selected>{{ $item }}</option>
                                        @else
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="text-danger ml-3">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select name="id_kecamatan" id="id_kecamatan" class="form-control @error('id_kecamatan') is-invalid @enderror" >
                                    @foreach ($kecamatan as $item)
                                        @if ($item->id_kecamatan == $sekolah->id_kecamatan)
                                            <option value="{{ $item->id_kecamatan  }}" selected>{{ $item->kecamatan  }}</option>
                                        @else
                                            <option value="{{ $item->id_kecamatan  }}">{{ $item->kecamatan  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="text-danger ml-3">
                                    @error('id_kecamatan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Alamat Sekolah</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"  value="{{ old('alamat', $sekolah->alamat) }}">
                                <div class="text-danger ml-3">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Posisi Sekolah</label>
                                <input type="text" name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror"  value="{{ old('posisi', $sekolah->posisi) }}">
                                <div class="text-danger ml-3">
                                    @error('posisi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Foto Sekolah</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpeg,.png,.jpg">
                            <div class="text-danger ml-3">
                                @error('foto')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label >Map</label>
                            <small>menentukan posisi sekolah</small>
                            <div id="map" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <div class="form-group">
                            <label>Deskripsi Sekolah</label>
                            <textarea name="deskripsi" id="descripsi" cols="30" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" >{{ $sekolah->deskripsi }}</textarea>
                            <div class="text-danger ml-3">
                                @error('deskripsi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-flat">Simpan</button>
                        <a href="/sekolah" class="btn btn-danger btn-flat">Kembali</a>
                    </div>

                    
                </form>

            </div>

        </div>
    </div>

    <script>
        $(function() {
                $('body').addClass('sidebar-collapse');
            
            var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11'
            });

            var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/satellite-v9'
            });


            var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/dark-v10'
            });

            var map = L.map('map', {
                center: [{{ $sekolah->posisi }}],
                zoom: 13,
                layers: [peta1]
            });

            var baseMaps = {
                "Grayscale": peta1,
                "Satellite": peta2,
                "Streets": peta3,
                "Dark": peta4
            };

            L.control.layers(baseMaps).addTo(map);

            // mengambil titik koordinat
            var curLocation = [{{ $sekolah->posisi }}];
            map.attributionControl.setPrefix(false);

            // buat marker agar bisa di pindah2 posisinya
            var marker = new L.marker(curLocation, {
                draggable : 'true'
            });

            // tampilkan marker 
            map.addLayer(marker);

            // ketika markernya di drag n drop
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable : 'true',
                }).bindPopup(position).update();
                $("#posisi").val(position.lat + "," + position.lng).keyup();
            });

            // ketika markernya di klik
            var posisi = document.querySelector("[name=posisi]");
            map.on("click", function(event) {
                var lat = event.latlng.lat;
                var lng = event.latlng.lng;

                if(!marker) {
                    marker = L.marker(event.latlng).addTo(map);
                }else{
                    marker.setLatLng(event.latlng);
                }
                posisi.value = lat + "," + lng;
            })

        })
    </script>

@endsection


