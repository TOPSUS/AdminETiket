<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_pembelian';
    protected $fillable = [
        'id_jadwal','id_user','bukti','tanggal','status',
    ];

    public function jadwal()
    {
        return $this->belongsTo('\App\Jadwal','id_jadwal');
    }

    public function user()
    {
        return $this->belongsTo('\App\User','id_user');
    }

    public function detailPembelian()
    {
        return $this->hasMany('\App\detailPembelian','id_pembelian');
    }

}