<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $primarykey ='id';
    protected $table = 'tb_jadwal';
    protected $fillable = [
        'waktu_berangkat','id_asal_pelabuhan','estimasi_waktu','id_tujuan_pelabuhan','id_kapal','harga','tanggal'
    ];

//relasi ke tb kapal
    public function kapal()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id')->withTrashed();;

    }
    public function kapal1()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id')->withTrashed();;
    }

//relasi ke tb pelabuhan
    public function asal()
    {
        return $this->belongsTo('App\Pelabuhan','id_asal_pelabuhan','id')->withTrashed();;
    }

    public function tujuan()
    {
        return $this->belongsTo('App\Pelabuhan','id_tujuan_pelabuhan','id')->withTrashed();;
    }

    public function asal1()
    {
        return $this->belongsTo('App\Pelabuhan','id_asal_pelabuhan')->withTrashed();;
    }

    public function tujuan1()
    {
        return $this->belongsTo('App\Pelabuhan','id_tujuan_pelabuhan')->withTrashed();;
    }


}
