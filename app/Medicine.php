<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "medicines";
    
    protected $fillable = [
        'name', 'urlImage', 'description', 'dosage'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
