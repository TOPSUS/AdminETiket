<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_review';
    protected $fillable = [
        'id_user','id_pembelian','review','score'
    ];

//relasi ke tb user
    public function user()
    {
        return $this->belongsTo('App\User','id_user', 'id');
    }

//relasi ke tb pembelian
    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian','id_pembelian', 'id');
    }

//getAllReview

    public static function getAllUserReview(){
        return Review::where('id_user',auth()->user()->id)->with('user')->paginate(10);
    }

}
