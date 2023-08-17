<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'category_id', 
        'name',
        'slug',
        'description',
        'cost',
        'quantity',
        'image',
        'is_featured',
        'is_available',
        'brand',
        'sku',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class, 'product_id');
    }
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')->withTimestamps();
    }

   
    
}
