<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
use HasFactory;

protected $table ='products';
protected $fillable = [
    'name',
    'description',
    'price'
];


/*
✅ $fillable protects against mass assignment vulnerabilities.
✅ You must list all fields that should be allowed for mass assignment.
✅ Use $guarded if you only want to block a few fields instead of allowing specific ones.php artisan make:migration create_products_table
php artisan make:model Product


*/


}
