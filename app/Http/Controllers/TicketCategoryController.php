<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TicketCategory;
use App\Http\Requests\TicketCategoryRequest;
use App\Http\Requests\TicketCategoryEditRequest;

class TicketCategoryController extends Controller
{

    protected $category;
    
    public function __construct(TicketCategory $category)
    {        
        $this->category = $category;
    }

    public function showIndex()
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->all();

            return view('ticket_category.index')->with(compact('category'));
        } else {
            abort(401);
        }
    }

    public function saveCreate(TicketCategoryRequest $request)
    {
        if (Auth::user()->type_id == 1) {
            $data['name'] = upperStart($request->name);

            $category = $this->category->create($data);

            $notification = array(
                'message' => 'Categoria cadastrada com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('categoryIndex')->with($notification);
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

            return redirect()->route('categoryIndex')->with($notification);
        } else {
            abort(401);
        }
    }

    public function showEdit($id)
    {
        if (Auth::user()->type_id == 1) {
            $categoryItem = $this->category->findOrFail($id);
            $category = $this->category->all();

            return view('ticket_category.edit')->with(compact('categoryItem'))->with(compact('category'));
        } else {
            abort(401);
        }
    }

    public function saveEdit(TicketCategoryEditRequest $request)
    {
        if (Auth::user()->type_id == 1) {
            $category = $this->category->findOrFail($request->id);
            
            $data['name'] = upperStart($request->name);
            
            $category->update($data);
            $category->save();

            $notification = array(
                'message' => 'Categoria alterada com sucesso',
                'alert-type' => 'success'
            );
            
            return redirect()->route('categoryIndex')->with($notification);
        } else {
            abort(401);
        }
    }

}