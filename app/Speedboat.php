<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speedboat extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_speedboat';
    protected $fillable = [
        'nama_speedboat','kapasitas','deskripsi','foto','contact_service','tanggal_beroperasi',
    ];

    //relasi ke tb reward
    public function reward() 
    {
        return $this->hasMany('App\rewardSpeedboat');
    }
}
