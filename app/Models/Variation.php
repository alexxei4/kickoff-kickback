<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// this is the model for variations
class Variation extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
