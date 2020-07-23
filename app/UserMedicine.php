<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMedicine extends Model
{
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "user_medicines";
    
    protected $fillable = [
        'price', 'user_id', 'medicine_id'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
