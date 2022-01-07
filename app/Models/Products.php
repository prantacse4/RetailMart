<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_name','bar_code','pro_company','cat_id','pro_quantity','pro_purchasing','pro_selling'
    ];
}
