@extends('layouts.frontend')

@section('container')
    
    <div id="map" style="width: 100%; height: 500px;"></div>


    <script>
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

        @foreach($kecamatan as $item)
            var data{{ $item->id_kecamatan }} = L.layerGroup();
        @endforeach

        var sekolah = L.layerGroup();

        var map = L.map('map', {
            center: [-6.985601, 109.571299],
            zoom: 11,
            layers: [peta1, 
            @foreach($kecamatan as $item)
                data{{ $item->id_kecamatan }},
            @endforeach
                    sekolah,]
        });

        var baseMaps = {
            "Grayscale": peta1,
            "Satellite": peta2,
            "Streets": peta3,
            "Dark": peta4
        };

        var overLayer = {
            @foreach($kecamatan as $data)
                "{{ $data->kecamatan }}": data{{ $data->id_kecamatan }},
            @endforeach
            "Sekolah" : sekolah,
        };

        L.control.layers(baseMaps, overLayer).addTo(map);


        @foreach($kecamatan as $data)
            L.geoJSON(<?= $data->geojson ?>, {
                style: {
                    color : "black",
                    fillColor : "{{ $data->warna }}"
                }
            }).addTo(data{{ $data->id_kecamatan }}).bindPopup("{{ $data->kecamatan }}");
        @endforeach

        @foreach($sekolah as $data)
            var iconSekolah = L.icon({
                iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',

                iconSize:     [40, 55], // size of the icon
            });

            var informasi = '<table class="table table-bordered"><thead><tr><th colspan="2" class="text-center"><img src="{{ asset("foto") }}/{{ $data->foto }}" width="250px"></th></tr></thead><tbody><tr><td>Nama Sekolah</td><td>{{ $data->nama_sekolah }}</td></tr><tr><td>Jenjang</td><td>{{ $data->jenjang }}</td></tr><tr><td>Status</td><td>{{ $data->status }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailsekolah/{{ $data->id_sekolah }}" class="btn btn-xs btn-info btn-block text-white">Detail</a></td></tr></tbody></table>';

            L.marker([<?= $data->posisi ?>], {icon: iconSekolah})
            .addTo(sekolah)
            .bindPopup(informasi);
        @endforeach

    </script>
@endsection