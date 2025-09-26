<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'description', 'content', 'title_seo', 'des_seo', 'keyword', 'state', 'slug', 'creator_id', 'sort', 'newscat_id'];
}
