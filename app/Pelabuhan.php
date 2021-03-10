<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelabuhan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_pelabuhan';
    protected $fillable = [
        'nama_pelabuhan','lokasi_pelabuhan','alamat_kantor', 'lama_beroperasi', 'status'. 'deskripsi', 'foto'
    ];
}
