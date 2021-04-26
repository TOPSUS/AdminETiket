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
        'id_jadwal','id_user','id_metode_pembayaran','id_golongan','nomor_polisi','bukti','tanggal','status','total_harga','file_tiket',
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

    public function golongans()
    {
        return $this->belongsTo('\App\Golongan','id_golongan');
    }

}
