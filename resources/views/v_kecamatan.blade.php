@extends('layouts.frontend')

@section('container')
    
    <div id="map" style="width: 100%; height: 500px;"></div>

    <div class="col-sm-12">
        <br>
        <br>
        <h3 class="text-center"><strong>Data Sekolah di Kecamatan {{ $kec->kecamatan }}</strong></h3>

        <table id="tabel-sekolah" class="table table-bordered table-striped text-sm">
            <thead class="text-center table-dark">
                <th width="20">No</th>
                <th>Nama Sekolah</th>
                <th>Jenjang</th>
                <th width="70">Status</th>
                <th>Coordinat</th>
            </thead>
            <tbody>
                
                    <?php $i=1; ?>
                    @foreach ($sekolah as $data)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $data->nama_sekolah }}</td>
                                <td class="text-center">{{ $data->jenjang }}</td>
                                <td class="text-center">
                                    {{ $data->status }}
                                </td>
                                <td class="text-center">
                                    {{ $data->posisi }}
                                </td>
                            </tr>
                    @endforeach
                
            </tbody>
        </table>
    </div>


    <script>
        $(function () {
            $("#tabel-sekolah").DataTable({
            "responsive": true,
            "autoWidth": false,
            });
            
        });

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

        var data{{ $kec->id_kecamatan }} = L.layerGroup();
        @foreach($jenjang as $item)
            var jenjang{{ $item->id_jenjang }} = L.layerGroup();
        @endforeach

        var map = L.map('map', {
            center: [-6.985601, 109.571299],
            zoom: 11,
            layers: [peta1, data{{ $kec->id_kecamatan }}, 
                    @foreach($jenjang as $item)
                        jenjang{{ $item->id_jenjang }},
                    @endforeach
                ]
        });

        var baseMaps = {
            "Grayscale": peta1,
            "Satellite": peta2,
            "Streets": peta3,
            "Dark": peta4
        };

        var overLayer = {
            "{{ $kec->kecamatan }}": data{{ $kec->id_kecamatan }},
            @foreach($jenjang as $item)
                "{{ $item->jenjang }}": jenjang{{ $item->id_jenjang }},
            @endforeach
        };

        L.control.layers(baseMaps, overLayer).addTo(map);


            var kec = L.geoJSON(<?= $kec->geojson ?>, {
                        style: {
                            color : "black",
                            fillColor : "{{ $kec->warna }}"
                        }
                    }).addTo(data{{ $kec->id_kecamatan }}).bindPopup("{{ $kec->kecamatan }}");

            map.fitBounds(kec.getBounds());

        @foreach($sekolah as $data)
            var iconSekolah = L.icon({
                iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',

                iconSize:     [40, 55], // size of the icon
            });

            var informasi = '<table class="table table-bordered"><thead><tr><th colspan="2" class="text-center"><img src="{{ asset("foto") }}/{{ $data->foto }}" width="250px"></th></tr></thead><tbody><tr><td>Nama Sekolah</td><td>{{ $data->nama_sekolah }}</td></tr><tr><td>Jenjang</td><td>{{ $data->jenjang }}</td></tr><tr><td>Status</td><td>{{ $data->status }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailsekolah/{{ $data->id_sekolah }}" class="btn btn-xs btn-info btn-block text-white">Detail</a></td></tr></tbody></table>';

            L.marker([<?= $data->posisi ?>], {icon: iconSekolah})
            .addTo(jenjang{{ $data->id_jenjang }})
            .bindPopup(informasi);
        @endforeach

    </script>
@endsection