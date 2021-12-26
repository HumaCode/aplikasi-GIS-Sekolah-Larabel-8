<?php

namespace App\Http\Controllers;

use App\Models\JenjangModel;
use App\Models\KecamatanModel;
use App\Models\SekolahModel;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->SekolahModel     = new SekolahModel();
        $this->JenjangModel     = new JenjangModel();
        $this->KecamatanModel   = new KecamatanModel();

        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Sekolah',
            'sekolah'   => $this->SekolahModel->AllData(),
        ];

        return view('admin.sekolah.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Tambah Data Sekolah',
            'jenjang'   => $this->JenjangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];

        return view('admin.sekolah.v_add', $data);
    }

    public function insert()
    {
        // validasi
        Request()->validate([
            'nama_sekolah'          => 'required',
            'id_jenjang'            => 'required',
            'status'                => 'required',
            'id_kecamatan'          => 'required',
            'alamat'                => 'required',
            'posisi'                => 'required',
            'foto'                  => 'required|max:1024'
        ],
        [
            'nama_sekolah.required'         => 'Wajib diisi!!',
            'id_jenjang.required'           => 'Wajib diisi!!',
            'status.required'               => 'Wajib diisi!!',
            'id_kecamatan.required'         => 'Wajib diisi!!',
            'alamat.required'               => 'Wajib diisi!!',
            'posisi.required'               => 'Wajib diisi!!',
            'foto.required'                 => 'Wajib diisi!!',
            'foto.max'                      => 'Maksimal 1 mb!!',
        ]);

        $file       = Request()->foto;
        $filename   = $file->hashName();
        $file->move(public_path('foto'), $filename);


        // ambil datanya
        $data = [
            'nama_sekolah'      => Request()->nama_sekolah,
            'id_jenjang'        => Request()->id_jenjang,
            'status'            => Request()->status,
            'id_kecamatan'      => Request()->id_kecamatan,
            'alamat'            => Request()->alamat,
            'posisi'            => Request()->posisi,
            'deskripsi'         => Request()->deskripsi,
            'foto'              => $filename
        ];

        // masukan ke model sekolah
        $this->SekolahModel->InsertData($data);

        return redirect()->route('sekolah')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_sekolah)
    {
        $data = [
            'title' => 'Edit Data Sekolah',
            'jenjang'   => $this->JenjangModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'sekolah' => $this->SekolahModel->DetailData($id_sekolah),
            'status'    => ['Negeri', 'Swasta'] 
        ];

        return view('admin.sekolah.v_edit', $data);
    }

    public function update($id_sekolah)
    {
        // validasi
        Request()->validate([
            'nama_sekolah'          => 'required',
            'id_jenjang'            => 'required',
            'status'                => 'required',
            'id_kecamatan'          => 'required',
            'alamat'                => 'required',
            'posisi'                => 'required',
            'foto'                  => 'max:1024'
        ],
        [
            'nama_sekolah.required'         => 'Wajib diisi!!',
            'id_jenjang.required'           => 'Wajib diisi!!',
            'status.required'               => 'Wajib diisi!!',
            'id_kecamatan.required'         => 'Wajib diisi!!',
            'alamat.required'               => 'Wajib diisi!!',
            'posisi.required'               => 'Wajib diisi!!',
            'foto.max'                      => 'Maksimal 1 mb!!',
        ]);

        if (Request()->foto <> "") {

            // hapus ikon lama
            $sekolah = $this->SekolahModel->DetailData($id_sekolah);
            if($sekolah->foto <> "") {
                unlink(public_path('foto') . '/' . $sekolah->foto);
            }

            $file       = Request()->foto;
            $filename   = $file->hashName();
            $file->move(public_path('foto'), $filename);


            // ambil datanya
            $data = [
                'nama_sekolah'      => Request()->nama_sekolah,
                'id_jenjang'        => Request()->id_jenjang,
                'status'            => Request()->status,
                'id_kecamatan'      => Request()->id_kecamatan,
                'alamat'            => Request()->alamat,
                'posisi'            => Request()->posisi,
                'deskripsi'         => Request()->deskripsi,
                'foto'              => $filename
            ];
    
            $this->SekolahModel->UpdateData($data, $id_sekolah);
        } else{
                // ambil datanya
                $data = [
                    'nama_sekolah'      => Request()->nama_sekolah,
                    'id_jenjang'        => Request()->id_jenjang,
                    'status'            => Request()->status,
                    'id_kecamatan'      => Request()->id_kecamatan,
                    'alamat'            => Request()->alamat,
                    'posisi'            => Request()->posisi,
                    'deskripsi'         => Request()->deskripsi,
                ];
    
            $this->SekolahModel->UpdateData($data, $id_sekolah);
        }
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil diedit');
    }

    public function delete($id_sekolah)
    {
        // hapus ikon lama
            $sekolah = $this->SekolahModel->DetailData($id_sekolah);
            if($sekolah->foto <> "") {
                unlink(public_path('foto') . '/' . $sekolah->foto);
            }

        // masukan ke model sekolah
        $this->SekolahModel->DeleteData($id_sekolah);
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil dihapus');
    }
}
