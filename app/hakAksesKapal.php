<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hakAksesKapal extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_hak_akses_kapal';
    protected $fillable = [
        'id_user','id_kapal','hak_akses',
    ];

    public function relasiUser()
    {
    	return $this->hasOne('App\User','id_user');
    }

    public function relasiSpeedboat()
    {
    	return $this->belongsTo('App\Speedboat','id_speedboat');
    }
}
