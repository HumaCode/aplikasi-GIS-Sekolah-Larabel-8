<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SekolahModel extends Model
{
    // use HasFactory;

    public function AllData()
    {
        return DB::table('tbl_sekolah')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang', '=', 'tbl_sekolah.id_jenjang')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_sekolah.id_kecamatan')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('tbl_sekolah')->insert($data);
    }

    public function DetailData($id_sekolah)
    {
        return DB::table('tbl_sekolah')->where('id_sekolah', $id_sekolah)->first();
    }

    public function UpdateData($data, $id_sekolah)
    {
        DB::table('tbl_sekolah')->where('id_sekolah', $id_sekolah)->update($data);
    }

    public function DeleteData($id_sekolah)
    {
        DB::table('tbl_sekolah')->where('id_sekolah', $id_sekolah)->delete();
    }
}
