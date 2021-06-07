<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Golongan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table ='tb_golongan';
    protected $fillable = [
        'id_pelabuhan','golongan','keterangan','harga','max_penumpang'
    ];

//relasi ke tb pelabuhan
    public function pelabuhan()
    {
        return $this->belongsTo('App\Pelabuhan','id_pelabuhan','id');
    }

}
