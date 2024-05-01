<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\Return_;
use Termwind\Components\Hr;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
        'user_id' ,
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];  

    public function category() : HasMany {
         return $this->hasMany( Category::class , 'user_id' , 'user_id') ;
    } 
    public function product() : HasMany  {
          return $this->hasMany(Product::class , 'user_id' , 'user_id'  ) ;
    }
    public function supplier() : HasMany { 
          return $this->hasMany(Supplier::class , 'user_id' , 'user_id') ;
    } 
    public function customer() :HasMany { 
          return $this->hasMany(Customer::class , 'user_id' ,'user_id' ) ;      
    } 
    public function invoice() : HasMany {
         return $this->hasMany(Invoice::class ,'user_id' ,'user_id' ) ;
    }
    public function invoiceProduct() : HasMany {
        return $this->hasMany(Invoiceproduct::class ,'user_id' ,'user_id' ) ;
   }
}
