<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
