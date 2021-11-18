<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class metodePembayaran extends Model
{
    use SoftDeletes;
    protected $primarykey ='id';
    protected $table = 'tb_metode_pembayaran';
    protected $fillable = [
        'metode','nama_metode','deskripsi_metode','nomor_rekening','logo_metode','payment_limit',
    ];

//relasi ke tb kapal
    public function pembelian()
    {
        return $this->hasMany('App\Pembelian','id_pembelian','id')->withTrashed();

    }
}
