<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;  

    protected $fillable = [
        'name', 
        'serial_number', 
        'model', 
        'category_id', 
        'sales_price', 
        'unit', 
        'image', 
        'tax',
     ] ;  

     public function category() 
     {
         return $this->belongsTo( Category::class ,'category_id' ,'id');
     } 
} 
