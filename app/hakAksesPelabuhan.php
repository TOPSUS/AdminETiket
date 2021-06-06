<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hakAksesPelabuhan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_hak_akses_pelabuhan';
    protected $fillable = [
        'id_user','id_pelabuhan','hak_akses',
    ];

    public function relasiUser()
    {
    	return $this->hasOne('App\User','id_user');
    }

    public function relasiPelabuhan()
    {
    	return $this->belongsTo('App\Pelabuhan','id_pelabuhan');
    }
}
