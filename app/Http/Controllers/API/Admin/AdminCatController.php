<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCatResource;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdminCatResource::collection(Category::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'language'=>$request->language,
            'name'=>$request->name,
            'show_at_nav' =>$request->show_at_nav,
            'status'=>$request->status
        ]);

        return new AdminCatResource($category);



    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new AdminCatResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message'=>'category was deleted'
        ]);
    }
}
