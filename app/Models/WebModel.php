<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    // use HasFactory;

    public function DataKecamatan()
    {
        return DB::table('tbl_kecamatan')->get();
    }

    public function DataJenjang()
    {
        return DB::table('tbl_jenjang')->get();
    }

    public function DetailKecamatan($id_kecamatan)
    {
        return DB::table('tbl_kecamatan')->where('id_kecamatan', $id_kecamatan)->first();
    }

    public function DataSekolah($id_kecamatan)
    {
        return DB::table('tbl_sekolah')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang', '=', 'tbl_sekolah.id_jenjang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_sekolah.id_kecamatan')
            ->where('tbl_sekolah.id_kecamatan', $id_kecamatan)
            ->get();
    }

    public function AllDataSekolah()
    {
        return DB::table('tbl_sekolah')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang', '=', 'tbl_sekolah.id_jenjang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_sekolah.id_kecamatan')
            ->get();
    }

    public function DetailSekolah($id_sekolah)
    {
        return DB::table('tbl_sekolah')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang', '=', 'tbl_sekolah.id_jenjang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_sekolah.id_kecamatan')
            ->where('id_sekolah', $id_sekolah)
            ->first();
    }

    public function DetailJenjang($id_jenjang)
    {
        return DB::table('tbl_jenjang')->where('id_jenjang', $id_jenjang)->first();
    }

    public function DataSekolahJenjang($id_jenjang)
    {
        return DB::table('tbl_sekolah')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang', '=', 'tbl_sekolah.id_jenjang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_sekolah.id_kecamatan')
            ->where('tbl_sekolah.id_jenjang', $id_jenjang)
            ->get();
    }
}
