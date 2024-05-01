<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory; 

    public function customer() :HasOne { 
         return $this->belongsTo(Customer::class , 'customer_id' , 'id') ;
    }
}
