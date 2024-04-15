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
    public function supplier() : HasOne {  
        return $this->HasOne(Supplier::class) ;

    }
}
