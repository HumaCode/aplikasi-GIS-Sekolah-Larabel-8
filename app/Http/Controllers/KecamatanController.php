<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->KecamatanModel = new KecamatanModel();

        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $this->KecamatanModel->AllData()
        ];

        return view('admin.kecamatan.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Kecamatan',
        ];

        return view('admin.kecamatan.v_add', $data);
    }

    public function insert()
    {
        // validasi
        Request()->validate([
            'kecamatan'     => 'required',
            'warna'         => 'required',
            'geojson'       => 'required'
        ],
        [
            'kecamatan.required'    => 'Wajib diisi!!',
            'warna.required'        => 'Wajib diisi!!',
            'geojson.required'      => 'Wajib diisi!!',
        ]);

        // ambil datanya
        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna'     => Request()->warna,
            'geojson'   => Request()->geojson,
        ];

        // masukan ke model kecamatan
        $this->KecamatanModel->InsertData($data);

        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_kecamatan)
    {
        $data = [
            'title' => 'Edit Data Kecamatan',
            'kecamatan' => $this->KecamatanModel->DetailData($id_kecamatan),
        ];

        return view('admin.kecamatan.v_edit', $data);
    }

    public function update($id_kecamatan)
    {
        // validasi
        Request()->validate([
            'kecamatan'     => 'required',
            'warna'         => 'required',
            'geojson'       => 'required'
        ],
        [
            'kecamatan.required'    => 'Wajib diisi!!',
            'warna.required'        => 'Wajib diisi!!',
            'geojson.required'      => 'Wajib diisi!!',
        ]);

        // ambil datanya
        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna'     => Request()->warna,
            'geojson'   => Request()->geojson,
        ];

        // masukan ke model kecamatan
        $this->KecamatanModel->UpdateData($data, $id_kecamatan);

        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil diedit');
    }

    public function delete($id_kecamatan)
    {
        // masukan ke model kecamatan
        $this->KecamatanModel->DeleteData($id_kecamatan);
        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil dihapus');
    }
}
