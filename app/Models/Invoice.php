<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory; 

    public function customer()  { 
         return $this->belongsTo(Customer::class ,'customer_id' ,'id') ;
    }  
    public function user() { 
        return $this->belongsTo(Customer::class ,'user_id' ,'user_id') ;
         
    } 
    public function  invoiceProduct() : HasMany { 
         return $this->hasMany(Invoiceproduct::class , 'invoiceProduct_id' ,'id') ;
    }
 
}
