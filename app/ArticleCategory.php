<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_category';
    protected $fillable = ['name', 'description'];
    protected $primaryKey = 'id';

    public function getArticle()
    {
        return $this->hasOne('App\Article', 'category_id', 'id');
    }
}
