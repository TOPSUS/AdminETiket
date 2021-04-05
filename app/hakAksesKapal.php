<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hakAksesKapal extends Model
{
    //
    protected $guarded = [];
    protected $table = 'tb_hak_akses_kapal';
    protected $fillable = [
        'id_user','id_kapal','hak_akses',
    ];

//relasi ke tb kapal
    public function kapal()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id');
        
    }
//relasi ke tb user
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
        
    }
}
