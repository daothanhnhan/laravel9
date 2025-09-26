<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 
    						'image', 
    						'image_sub', 
    						'description', 
    						'content', 

    						'price',
    						'price_sale',
    						'product_code',
    						'product_shape',
    						'product_size',
    						'product_brand',
    						'product_origin',
    						'product_text_1',
    						'product_text_2',
    						'product_text_3',
    						'product_text_4',
    						'product_text_5',
    						'product_text_6',

    						'title_seo', 
    						'des_seo', 
    						'keyword', 

    						'state', 
    						'product_new', 
    						'product_hot', 
    						'slug', 
    						'creator_id', 
    						'sort', 
    						'productcat_id'];
}
