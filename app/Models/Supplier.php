<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'supplier_name',
        'contact',
        'address',
        'description',


    ]; 
    public function user() {
         return $this->belongsTo( User::class , 'user_id' ,'user_id') ;
    }  
    public function supplier() { 
         return $this->belongsTo(Product::class ,'product_id' , 'id' ) ;
    }
    
}
