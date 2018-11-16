<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use App\ArticleCategory;
use App\Article;

class ArticleController extends Controller
{
    
    protected $article;
    protected $category;

    public function __construct(ArticleCategory $category, Article $article)
    {
        $this->category = $category;
        $this->article = $article;
    }

    public function showIndex()
    {
        if (Auth::user()->type_id == 1) {
            $article = $this->article->all();
            
            return view('article.index')->with(compact('article'));
        } else {
            abort(401);
        }         
    }

    public function showCreate()
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->all();
            
            return view('article.create')->with(compact('category'));
        } else {
            abort(401);
        }
    }

    public function saveCreate(ArticleRequest $request)
    {        
        if (Auth::user()->type_id == 1) {
            $data = [
                'title' => upperFirst($request->title),
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id
            ];
            
            $article = $this->article->create($data);
        
            $notification = array(
                'message' => 'Artigo adicionado com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('articleIndex')->with($notification);

        } else {
            abort(401);
        }        
    }

    public function saveDelete($id)
    {
        if (Auth::user()->type_id == 1) {
            $article = $this->article->findOrFail($id);
            $article->delete();
    
            $notification = array(
                'message' => 'Artigo apagado com sucesso',
                'alert-type' => 'success'
            );
            
            return redirect()->route('articleIndex')->with($notification);
        } else {
            abort(401);
        }
    }

    public function showEdit($id)
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->all();
            $article = $this->article->findOrFail($id);
            
            return view('article.edit')->with(compact('category'))->with(compact('article'));
        } else {
            abort(401);
        }
    }

    public function saveEdit(ArticleRequest $request)
    {
        if (Auth::user()->type_id == 1) {            
            $article = $this->article->findOrFail($request->id);

            $data = [
                'title' => upperFirst($request->title),
                'content' => $request->content,
                'category_id' => $request->category_id                
            ];

            $article->update($data);
            $article->save();

            $notification = array(
                'message' => 'Artigo alterado com sucesso',
                'alert-type' => 'success'
            );
            
            return redirect()->route('articleIndex')->with($notification);                        
        } else {
            abort(401);
        }
    }

}
