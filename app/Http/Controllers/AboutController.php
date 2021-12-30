<?php

namespace App\Http\Controllers;

use App\Models\WebModel;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'About',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'sekolah' => $this->WebModel->AllDataSekolah(),
            'jenjang' => $this->WebModel->DataJenjang()
        ];

        return view('v_about', $data);
    }
}
