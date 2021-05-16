<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class beritaPelabuhan extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_berita_pelabuhan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pelabuhan','id_user','judul','berita','tanggal','foto'
    ];
    public function relasiPelabuhan()
    {
    	return $this->belongsTo('App\Pelabuhan','id_pelabuhan')->withTrashed();
    }
    public function relasiUser()
    {
    	return $this->belongsTo('App\User','id_user','id')->withTrashed();
    }

}
