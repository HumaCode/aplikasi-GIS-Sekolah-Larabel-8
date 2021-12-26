<?php

namespace App\Http\Controllers;

use App\Models\WebModel;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Pemetaan',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah' => $this->WebModel->AllDataSekolah(),
            'jenjang' => $this->WebModel->DataJenjang()
        ];

        return view('v_web', $data);
    }

    public function kecamatan($id_kecamatan)
    {
        $kec = $this->WebModel->DetailKecamatan($id_kecamatan);

        $data = [
            'title'     => 'Kecamatan ' . $kec->kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah'   => $this->WebModel->DataSekolah($id_kecamatan),
            'jenjang' => $this->WebModel->DataJenjang(),
            'kec'       => $kec
        ];

        return view('v_kecamatan', $data);
    }

    public function jenjang($id_jenjang)
    {
        $jenjang = $this->WebModel->DetailJenjang($id_jenjang);

        $data = [
            'title'     => 'Jenjang ' . $jenjang->jenjang,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah'   => $this->WebModel->DataSekolahJenjang($id_jenjang),
            'jenjang'   => $this->WebModel->DataJenjang(),
        ];

        return view('v_jenjang', $data);
    }

    public function detailsekolah($id_sekolah)
    {
        $skl = $this->WebModel->DetailSekolah($id_sekolah);

        $data = [
            'title'     => 'Detail ' . $skl->nama_sekolah,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'jenjang'   => $this->WebModel->DataJenjang(),
            'sekolah' => $skl
        ];

        return view('v_detail-sekolah', $data);
    }
}
