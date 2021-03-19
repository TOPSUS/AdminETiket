<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailPembelian extends Model
{
    //
    protected $guarded = [];
    protected $table = 'tb_detail_pembelian';
    protected $fillable = [
        'id_pembelian', 'id_card', 'kode_tiket', 'nama_pemegang_tiket', 'no_id_card', 'harga', 'QRCode', 'status',
    ];

    //relasi ke tb card
    public function card()
    {
        return $this->belongsTo('App\Card','id_card','id');
    }

    //relasi ke tb pembelian
    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian','id_pembelian','id');
    }
}
