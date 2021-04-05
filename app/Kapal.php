<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kapal extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_kapal';
    protected $fillable = [
        'nama_kapal','kapasitas','deskripsi','foto','contact_service','tanggal_beroperasi','tipe_kapal',
    ];

    public function relasiHakAkses() 
    {
        return $this->hasMany('App\hakAksesKapal');
    }

    public function relasiJadwal() 
    {
        return $this->hasMany('App\Jadwal');
    }
}
