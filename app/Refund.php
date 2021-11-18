<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    //
    use SoftDeletes;
    protected $primarykey ='id';
    protected $table = 'tb_refund';
    protected $fillable = [
        'id_pembelian','id_sup_admin','id_persenan','refund','tanggal','alasan','no_rekening','status',
    ];

//relasi ke tb kapal
    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian','id_pembelian','id')->withTrashed();;

    }

    public function user()
    {
        return $this->belongsTo('App\User','id_sup_admin','id')->withTrashed();;

    }

    public function persentase()
    {
        return $this->belongsTo('App\JumlahRefund','id_persenan','id')->withTrashed();;

    }
}
