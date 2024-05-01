<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id' ,
        'name',
        'serial_number',
        'model',
        // 'category_id', 
        'sales_price',
        "purshase_price" ,
        //'unit', 
        'image',
        'tax', 

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    } 
    public function supplier() { 
        return $this->belongsTo(Supplier::class ,'supplier_id' , 'id' ) ;
   }   
   public function invoiceProduct() : HasOne { 
      return $this->hasOne(Invoiceproduct::class) ;
      
   }
}
