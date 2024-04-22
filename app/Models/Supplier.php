<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Supplier extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'suplier_name',
        'contact',
        'address',
        'description',


    ]; 
    public function user() {
         return $this->belongsTo( User::class , 'user_id' ,'user_id') ;
    }  
  
    public function product() : HasOne {  
        return $this->HasOne(Product::class) ;

    }
    
}
