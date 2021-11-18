<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JumlahRefund extends Model
{
    use SoftDeletes;
    protected $primarykey ='id';
    protected $table = 'tb_jumlah_refund';
    protected $fillable = [
        'persenan_refund',
    ];

//relasi ke tb kapal
    public function refund()
    {
        return $this->hasMany('App\Refund','id_persenan','id')->withTrashed();

    }
}
