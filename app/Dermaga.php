<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dermaga extends Model
{
    // 
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_dermaga';
    protected $fillable = [
        'id_pelabuhan','nama_dermaga',
    ];

    public function relasiPelabuhan()
    {
    	return $this->belongsTo('App\Pelabuhan','id_pelabuhan');
    }
}
