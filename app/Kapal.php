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
        'nama_kapal','deskripsi','foto','tanggal_beroperasi',
    ];
}
