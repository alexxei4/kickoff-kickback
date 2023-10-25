<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkuController extends Controller
{
    public function generateSKU($category, $brand, $size, $color)
    {
     
        $skuLength = 8;

        
        $randomChars = str_random($skuLength);

        $sku = "{$category}-{$brand}-{$size}-{$color}-{$randomChars}";

        return $sku;
    }
}
