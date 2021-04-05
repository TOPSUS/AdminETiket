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

<<<<<<< HEAD
//relasi ke tb speedboat
    public function speedboat()
    {
        return $this->belongsTo('App\Speedboat','id_speedboat','id');
    }

//relasi ke reward speedboat
    public function reward()
    {
    
    return $this->hasMany('App\rewardSpeedboat');
    }
=======
    //relasi ke tb speedboat
        public function speedboat()
        {
            return $this->belongsTo('App\hakAksesSpeedboat','id_speedboat');
        }
    
    //relasi ke tb kapal  
        public function kapal()
        {
            return $this->belongsTo('App\hakAksesKapal','id_kapal');
        }
>>>>>>> de8f29abeb685219f0ae0744e40e68eb5f1e64a7
}
