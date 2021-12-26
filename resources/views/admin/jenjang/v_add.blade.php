@extends('layouts.backend')

@section('content')

    <div class="col-md">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data</h3>
            </div>
        
            <div class="card-body">
                
                <form action="/jenjang/insert" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Jenjang</label>
                                <input type="text" name="jenjang" class="form-control @error('jenjang') is-invalid @enderror" placeholder="Jenjang Pendidikan"  value="{{ old('jenjang') }}">
                                <div class="text-danger ml-3">
                                    @error('jenjang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Icon</label>
                                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/png" value="{{ old('icon') }}">
                            
                            <div class="text-danger ml-3">
                                @error('icon')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-flat">Simpan</button>
                        <a href="/jenjang" class="btn btn-danger btn-flat">Kembali</a>
                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection


