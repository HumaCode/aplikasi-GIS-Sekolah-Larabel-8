@extends('layouts.backend')

@section('content')
    
    <div class="col-md">

        {{-- pesan flash --}}
        @if (session('pesan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('pesan') }}
            </div>
        @endif

        <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>

            <div class="card-tools">
            <a href="/user/add"  class="btn btn-primary btn-xs btn-flat" ><i class="fas fa-plus"></i> Tambah User
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            
            <table id="example1" class="table table-bordered table-striped text-sm">
                <thead class="text-center">
                    <th width="20">No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Foto</th>
                    <th width="80">Aksi</th>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($user as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->password }}</td>
                            <td class="text-center">
                                <img src="{{ asset('foto') }}/{{ $data->foto }}" width="70" alt="">
                            </td>
                            <td class="text-center">
                                <a href="/user/edit/{{  $data->id  }}" class="btn btn-warning btn-flat"><i class="fas fa-edit"></i></a>
                                <a href="/user/delete/{{  $data->id  }}" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


    @foreach ($user as $data)
        <div class="modal fade" id="delete{{ $data->id }}">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <h3>Apakah yakin akan menghapus user {{ $data->name }}.?</h3>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="/user/delete/{{ $data->id }}" class="btn btn-primary">Ya, Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach

    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            });
            
        });
    </script>

@endsection