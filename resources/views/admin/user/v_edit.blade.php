@extends('layouts.backend')

@section('content')

<div class="col-md">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>
        </div>
    
        <div class="card-body">
            
            <form action="/user/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama User"  value="{{ old('name', $user->name) }}">
                            <div class="text-danger ml-3">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email', $user->email) }}" readonly>
                            <div class="text-danger ml-3">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password', $user->password) }}" readonly>
                            <div class="text-danger ml-3">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept=".png,.jpeg,.jpg">
                        
                        <div class="text-danger ml-3">
                            @error('foto')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-primary btn-flat">Simpan</button>
                    <a href="/user" class="btn btn-danger btn-flat">Kembali</a>
                </div>
            </form>

        </div>

    </div>
</div>

@endsection


