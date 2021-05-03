<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tb_user_notification';
    protected $fillable = [
        'user_id','title','body','notification_by','status','type',
    ];
}
