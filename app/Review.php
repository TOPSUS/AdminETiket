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
        'id_speedboat','id_user','id_pembelian','review','score'
    ];

//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Speedboat','id_speedboat');
    }

//relasi ke tb user
    public function user()
    {
        return $this->belongsTo('App\User','id', 'id_user');
    }

//relasi ke tb pembelian
    public function pembelian()
    {
        return $this->belongsTo('App\Pembelian','id_pembelian', 'id');
    }

//getAllReview
    public static function getAllReview()
    {
        return Review::with('id_user')->paginate(10);
    }
    public static function getAllUserReview(){
        return Review::where('id_user',auth()->user()->id)->with('user')->paginate(10);
    }

}
