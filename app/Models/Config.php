<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = ['title', 
    						'description', 
    						'keyword', 
    						'intro',

    						'logo',
    						'icon',
    						'banner_1',
    						'banner_2',
    						'banner_3',
    						'banner_4',
    						'banner_5',

    						'content_home_1',
    						'content_home_2',
    						'content_home_3',
    						'content_home_4',
    						'content_home_5',
    						'content_home_6',
    						'content_home_7',
    						'content_home_8',
    						'content_home_9',
    						'content_home_10',

    						'embed_code_header', 
    						'embed_code_footer'];
}
