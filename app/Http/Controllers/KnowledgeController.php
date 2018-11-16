<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleCategory;
use App\Article;

class KnowledgeController extends Controller
{
    
    protected $category;
    protected $article;

    public function __construct(Article $article, ArticleCategory $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    public function showIndex()
    {
        $article = $this->article->all();
        $categoryArticle = $this->category->whereHas('getArticle', function ($query) {
        })->take(6)->get();
        
        $category = [];
        foreach($categoryArticle as $key => $c){
            $countArticle = $this->article->where('category_id', $c->id)->count();
            $category[$key] = [
                'id' => $c->id,
                'name' => $c->name,
                'count' => $countArticle
            ];
        }
    
        return view('knowledge.index')->with(compact('article'))->with(compact('category'));
    }

    public function showSearch()
    {
        return view('knowledge.search');
    }

}
