<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    use HasFactory; 
  protected $fillable = [
     'id' , 
     'status' ,
      'name' ,
  ] ; 
  public function user() 
  {
      return $this->belongsTo(User::class ,'user_id' ,'user_id');
  } 

 public function product() : HasMany {
   return $this->HasMany( Product::class  ,'categry_id' ,'id') ;
 }

}
