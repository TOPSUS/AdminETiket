<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rewardSpeedboat extends Model
{
    //
    protected $guarded = [];
    protected $table = 'tb_reward_speedboat';
    protected $fillable = [
        'id_speedboat','reward','berlaku','minimal_point','foto',
    ];

//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Speedboat','id_speedboat','id');
    }

}
