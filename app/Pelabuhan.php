<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelabuhan extends Model
{
    //
    protected $guarded = [];
    protected $table = 'tb_pelabuhan';
    protected $fillable = [
        'nama_pelabuhan','lokasi_pelabuhan','alamat_kantor', 'lama_beroperasi', 'status'
    ];
}
