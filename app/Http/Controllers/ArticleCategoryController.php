<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleCategoryRequest;
use App\Http\Requests\ArticleCategoryEditRequest;
use App\ArticleCategory;

class ArticleCategoryController extends Controller
{

    protected $category;
    
    public function __construct(ArticleCategory $category)
    {
        $this->category = $category;        
    }
    
    public function showIndex()
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->all();

            return view('article_category.index')->with(compact('category'));
        } else {
            abort(401);
        }            
    }

    public function showCreate()
    {
        if (Auth::user()->type_id == 1) {            

            return view('article_category.create');

        } else {
            abort(401);
        }        
    }

    public function saveCreate(ArticleCategoryRequest $request)
    {
        if (Auth::user()->type_id == 1) {

            $data = [
                'name' => upperStart($request->name),
                'description' => upperFirst($request->description)
            ];

            $category = $this->category->create($data);

            $notification = array(
                'message' => 'Categoria adicionada com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('articleCategoryIndex')->with($notification);
        } else {
            abort(401);
        }
    }

    public function saveDelete($id)
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->findOrFail($id);
            $category->delete();

            $notification = array(
                'message' => 'Categoria apagada com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('articleCategoryIndex')->with($notification);
        } else {
            abort(401);
        }
    }

    public function showEdit($id)
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->findOrFail($id);            

            return view('article_category.edit')->with(compact('category'));
        } else {
            abort(401);
        }
    }

    public function saveEdit(ArticleCategoryEditRequest $request)
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->findOrFail($request->id);

            $data = [
                'name' => upperStart($request->name),
                'description' => upperFirst($request->description)
            ];

            $category->update($data);
            $category->save();

            $notification = array(
                'message' => 'Categoria alterada com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('articleCategoryIndex')->with($notification);
        } else {
            abort(401);
        }
    }

}
