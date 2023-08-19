<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    const ADMIN = 'admin';
    const USER = 'user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Define the many-to-many relationship with products and their associated special prices.
     *
     * This function defines a many-to-many relationship between the User model and the Product model.
     * It specifies the pivot table 'product_user' and includes the 'special_price' column in the pivot table.
     * The pivot table uses 'user_id' as the foreign key for users and 'product_id' as the foreign key for products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany The many-to-many relationship with products' special prices.
     */
    public function prices()
    {
        return $this->belongsToMany(Product::class, 'product_user', 'user_id', 'product_id')->withPivot('special_price');
    }
}
