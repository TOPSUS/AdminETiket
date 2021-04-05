<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class beritaKapal extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_berita_kapal';
    protected $fillable = [
        'id_kapal','id_user','judul','berita','tanggal','foto'
    ];

    public function relasiUser()
    {
    	return $this->belongsTo('App\User','id_user','id');
    }

    public function relasiSpeedboat()
    {
    	return $this->belongsTo('App\Kapal','id_kapal');
    }
}
