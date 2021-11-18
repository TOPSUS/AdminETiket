<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detailJadwal extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $primarykey ='id';
    protected $table = 'tb_detail_jadwal';
    protected $fillable = [
        'id_jadwal','hari','status','id_dermaga_asal','id_dermaga_tujuan',
    ];

    public function relasiJadwal()
    {
        return $this->belongsTo('App\Jadwal','id_jadwal','id');

    }
}
