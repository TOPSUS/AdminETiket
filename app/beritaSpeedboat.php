<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class beritaSpeedboat extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_berita_speedboat';
    protected $fillable = [
        'id_speedboat','id_user','judul','berita','tanggal','foto'
    ];

    public function relasiUser()
    {
    	return $this->belongsTo('App\User','id_user','id');
    }

    public function relasiSpeedboat()
    {
    	return $this->belongsTo('App\Speedboat','id_speedboat');
    }
}
