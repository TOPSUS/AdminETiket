<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class anggotaPelabuhan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_anggota_pelabuhan';
    protected $fillable = [
        'id_pelabuhan','id_kapal','status',
    ];

    public function relasiPelabuhan()
    {
    	return $this->belongsTo('App\Pelabuhan','id_pelabuhan');
    }

    public function relasiKapal()
    {
    	return $this->belongsTo('App\Kapal','id_kapal');
    }
}
