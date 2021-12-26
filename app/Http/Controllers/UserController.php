<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->UserModel     = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->UserModel->AllData()
        ];

        return view('admin.user.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah User ',
        ];

        return view('admin.user.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|min:8',
            'foto'      => 'required|max:1024',
        ],
        [
            'name.required'         => 'Wajib diisi',
            'email.required'        => 'Wajib diisi',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Wajib diisi',
            'password.min'          => 'Password Minimal 8 karakter',
            'foto.required'         => 'Wajib diisi',
            'foto.max'              => 'Foto Maksimal 1 Mb',
        ]);

        $file       = Request()->foto;
        $filename   = $file->hashName();
        $file->move(public_path('foto'), $filename);

        $data = [
            'name'          => Request()->name,
            'email'         => Request()->email,
            'password'      => Hash::make(Request()->password),
            'foto'          => $filename
        ];

        $this->UserModel->InsertData($data);

        return redirect()->route('user')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title'     => 'Edit Data User ',
            'user'   => $this->UserModel->DetailData($id)
        ];

        return view('admin.user.v_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'foto'      => 'max:1024',
        ],
        [
            'name.required'         => 'Wajib diisi',
            'email.required'        => 'Wajib diisi',
            'password.required'     => 'Wajib diisi',
            'foto.max'              => 'Foto Maksimal 1 Mb',
        ]);

        if (Request()->foto <> "") {

            // hapus foto lama
            $user = $this->UserModel->DetailData($id);
            if($user->foto <> "") {
                unlink(public_path('foto') . '/' . $user->foto);
            }

            $file       = Request()->foto;
            $filename   = $file->hashName();
            $file->move(public_path('foto'), $filename);


            $data = [
                'name'          => Request()->name,
                'email'         => Request()->email,
                'password'      => Request()->password,
                'foto'          => $filename
            ];
    
            $this->UserModel->UpdateData($data, $id);
        } else{
            $data = [
                'name'          => Request()->name,
                'email'         => Request()->email,
                'password'      => Request()->password,
            ];
    
            $this->UserModel->UpdateData($data, $id);
        }
        return redirect()->route('user')->with('pesan', 'Data berhasil diedit');        
    }

    public function delete($id)
    {
        // hapus ikon lama
            $user = $this->UserModel->DetailData($id);
            if($user->foto <> "") {
                unlink(public_path('foto') . '/' . $user->foto);
            }

        // masukan ke model user
        $this->UserModel->DeleteData($id);
        return redirect()->route('user')->with('pesan', 'Data berhasil dihapus');
    }
}
