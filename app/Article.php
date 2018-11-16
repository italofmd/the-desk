<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $table = 'article';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content', 'view_count', 'category_id', 'user_id'];

    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getCategory()
    {
        return $this->hasOne('App\ArticleCategory', 'id', 'category_id');
    }

}
