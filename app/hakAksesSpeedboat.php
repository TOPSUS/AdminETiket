<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hakAksesSpeedboat extends Model
{
//
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_hak_akses_speedboat';
    protected $fillable = [
        'id_user','id_speedboat','hak_akses',
    ];

//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Speedboat','id_speedboat','id');

    }
//relasi ke tb user
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');

    }
}
