<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// this is the model for category 
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable =[
            'name',
            'slug',
            'description',
    ] ;
}
