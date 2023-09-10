<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryCreateRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.category.index' , compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.category.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryCreateRequest $request)
    {
        $category = new Category();
        $category->language = $request->language;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast(__('Created Successfuly'),'success')->width('350');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $languages = Language::all();
        return view('admin.category.edit', compact('languages' , 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->language = $request->language;
        $category->slug = \Str::slug($request->name);
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast(__('Update Successfuly'),'success')->width('350');

        return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            // if($category->language === 'en'){
            //     return response(['status'=>'error' , 'message'=>__('Can\'t Delete Thi One')]);
            // }
            $category->delete();
            return response(['status'=>'success' , 'message'=>__('deleted successfuly')]);

        } catch(\Throwable $th) {
            return response(['status'=>'error' , 'message'=>__('somthing went wrong!')]);
        }
    }
}
