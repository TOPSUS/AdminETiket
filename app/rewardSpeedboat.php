<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rewardSpeedboat extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_reward_speedboat';
    protected $fillable = [
        'id_speedboat','reward','berlaku','minimal_point','foto',
    ];

//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Kapal','id_speedboat','id');
    }

}
