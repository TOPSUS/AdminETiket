<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //
    protected $guarded = [];
    protected $table = 'tb_jadwal';
    protected $fillable = [
        'waktu_berangkat','id_asal_pelabuhan','waktu_sampai','id_tujuan_pelabuhan','id_speedboat','harga',
    ];

//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Speedboat','id_speedboat','id');
    }

//relasi ke tb pelabuhan
    public function asal()
    {
        return $this->belongsTo('App\Pelabuhan','id_asal_pelabuhan');
    }

    public function tujuan()
    {
        return $this->belongsTo('App\Pelabuhan','id_tujuan_pelabuhan');
    }

}