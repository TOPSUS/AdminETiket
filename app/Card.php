<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    //
    protected $guarded = [];
    protected $table ='tb_card';
    protected $fillable = [
        'card'
    ];
}
