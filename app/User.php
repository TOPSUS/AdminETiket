<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'tb_user';

    protected $fillable = [
        'nama','alamat','jeniskelamin', 'nohp', 'email', 'password', 'foto', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//relasi ke tb speedboat
    public function kapal()
    {
        return $this->belongsTo('App\Kapal','id_kapal','id');
    }

//relasi ke tb pelabuhan
    public function pelabuhan()
    {
        return $this->belongsTo('App\Pelabuhan','id_pelabuhan','id');
    }

//relasi ke reward speedboat
    public function reward()
    {

    return $this->hasMany('App\rewardSpeedboat');
    }

    public function refund()
    {
        return $this->hasMany('App\Refund','id_sup_admin','id')->withTrashed();
    }
}
