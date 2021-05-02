<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelabuhan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_pelabuhan';
    protected $fillable = [
        'kode_pelabuhan','nama_pelabuhan','lokasi_pelabuhan','alamat_kantor', 'lama_beroperasi','deskripsi', 'foto','tipe_pelabuhan','status',
    ];
    public function asal()
    {
        return $this->HasMany('App\Jadwal','id','id_asal_pelabuhan');
    }

    public function tujuan()
    {
        return $this->HasMany('App\Jadwal','id','id_tujuan_pelabuhan');
    }
}
