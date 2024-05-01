<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'contact',
        'address',
        'email',
        'details'
         ];
    public function user()
    { 
         return $this->belongs( User::class ,'user_id' ,'user_id') ; 

    }   
    public function  invoice() :HasMany { 
         return $this->hasMany(Invoice::class , 'invoice_id' , 'id') ;
    }
}
