<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "sale";
    
    protected $fillable = [
        'amount', 'user_medicine_id',
    ];

    protected $hidden = [
        'deleted_at', 'user_medicine_id'
    ];
    
    public function userMedicine(){
        return $this->hasOne('App\UserMedicine','id','user_medicine_id')
            ->select('id', 'price', 'medicine_id', 'user_id');
    }
}
