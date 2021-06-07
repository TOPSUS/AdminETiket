<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detailGolongan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table ='tb_detail_golongan';
    protected $fillable = [
        'id_kapal','id_golongan','jumlah',
    ];

    //relasi ke tb pelabuhan
    public function kapal()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id');
    }

    //relasi ke tb pelabuhan
    public function golongan()
    {
        return $this->belongsTo('App\Golongan','id_golongan','id');
    }
}
