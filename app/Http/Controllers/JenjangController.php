<?php

namespace App\Http\Controllers;

use App\Models\JenjangModel;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    public function __construct()
    {
        $this->JenjangModel = new JenjangModel();

        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Jenjang',
            'jenjang' => $this->JenjangModel->AllData()
        ];

        return view('admin.jenjang.v_index', $data);
    }


    public function add()
    {
        $data = [
            'title' => 'Tambah Jenjang Pendidikan',
        ];

        return view('admin.jenjang.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'jenjang'   => 'required',
            'icon'      => 'required|max:1024',
        ],
        [
            'jenjang.required'  => 'Wajib diisi',
            'icon.required'     => 'Wajib diisi'
        ]);

        $file       = Request()->icon;
        $filename   = $file->hashName();
        $file->move(public_path('icon'), $filename);

        $data = [
            'jenjang'   => Request()->jenjang,
            'icon'      => $filename
        ];

        $this->JenjangModel->InsertData($data);

        return redirect()->route('jenjang')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_jenjang)
    {
        $data = [
            'title'     => 'Edit Jenjang Pendidikan',
            'jenjang'   => $this->JenjangModel->DetailData($id_jenjang)
        ];

        return view('admin.jenjang.v_edit', $data);
    }

    public function update($id_jenjang)
    {
        Request()->validate([
            'jenjang'   => 'required',
            'icon'      => 'max:1024',
        ],
        [
            'jenjang.required'  => 'Wajib diisi',
        ]);

        if (Request()->icon <> "") {

            // hapus ikon lama
            $jenjang = $this->JenjangModel->DetailData($id_jenjang);
            if($jenjang->icon <> "") {
                unlink(public_path('icon') . '/' . $jenjang->icon);
            }

            $file       = Request()->icon;
            $filename   = $file->hashName();
            $file->move(public_path('icon'), $filename);


            $data = [
                'jenjang'   => Request()->jenjang,
                'icon'      => $filename
            ];
    
            $this->JenjangModel->UpdateData($data, $id_jenjang);
        } else{
            $data = [
                'jenjang'   => Request()->jenjang,
            ];
    
            $this->JenjangModel->UpdateData($data, $id_jenjang);
        }
        return redirect()->route('jenjang')->with('pesan', 'Data berhasil diedit');        
    }

    public function delete($id_jenjang)
    {
        // hapus ikon lama
            $jenjang = $this->JenjangModel->DetailData($id_jenjang);
            if($jenjang->icon <> "") {
                unlink(public_path('icon') . '/' . $jenjang->icon);
            }

        // masukan ke model jenjang
        $this->JenjangModel->DeleteData($id_jenjang);
        return redirect()->route('jenjang')->with('pesan', 'Data berhasil dihapus');
    }
}
