<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $guarded = [];
    protected $table ='tb_card';
    protected $fillable = [
        'card'
    ];
}
