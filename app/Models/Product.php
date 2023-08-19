<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'quantity', 'image_path', 'status'];

    /**
     * Define the many-to-many relationship with users and their special prices for a product.
     *
     * This function defines a many-to-many relationship between the Product model and the User model.
     * It specifies the pivot table 'product_user' and includes the 'special_price' column in the pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany The many-to-many relationship with users' special prices.
     */
    public function specialPrices()
    {
        return $this->belongsToMany(User::class, 'product_user')->withPivot('special_price');
    }

    /**
     * Get the user-specific special price for a given product.
     *  */
    public static function getUserSpecificPrice($product, $user)
    {
        // Retrieve the special price data from the 'specialPrices' relationship
        $priced = $product
            ->specialPrices()
            ->where('user_id', $user)
            ->first();

        // Return the special price from the pivot data, or an empty string if not found
        return $priced->pivot->special_price ?? '';
    }
}
