<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// this is the model for the SKU
class Sku extends Model
{
    protected $fillable = ['code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
