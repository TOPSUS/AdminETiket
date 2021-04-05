<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jadwalKapal extends Model
{
 //
    use SoftDeletes;
    protected $guarded = [];
    protected $primarykey ='id';
    protected $table = 'tb_jadwal_kapal';
    protected $fillable = [
        'waktu_berangkat','id_asal_pelabuhan','waktu_sampai','id_tujuan_pelabuhan','id_kapal','harga','tanggal'
    ];

    //relasi ke tb kapal
    public function kapal()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id');
        
    }
    public function kapal1()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id');
    }



    //relasi ke tb pelabuhan
    public function asal()
    {
        return $this->belongsTo('App\Pelabuhan','id_asal_pelabuhan','id');
    }

    public function tujuan()
    {
        return $this->belongsTo('App\Pelabuhan','id_tujuan_pelabuhan','id');
    }

    public function asal1()
    {
        return $this->belongsTo('App\Pelabuhan','id_asal_pelabuhan');
    }

    public function tujuan1()
    {
        return $this->belongsTo('App\Pelabuhan','id_tujuan_pelabuhan');
    }



}
