<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detailPembelian extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_detail_pembelian';
    protected $fillable = [
        'id_pembelian', 'id_card', 'kode_tiket', 'nama_pemegang_tiket', 'no_id_card', 'harga', 'status',
    ];

    //relasi ke tb card
    public function card()
    {
        return $this->belongsTo('App\Card','id_card','id')->withTrashed();;
    }

    //relasi ke tb pembelian
    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian','id_pembelian','id')->withTrashed();;
    }
}
