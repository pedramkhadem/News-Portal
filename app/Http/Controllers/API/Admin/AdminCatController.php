<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCatResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = Category::where('language' , request('lang' ,'en'))->paginate(20);
        return AdminCatResource::collection($result);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(FormRequest $request)
    {

        $validated = $request->safe()->all();



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
    public function update(FormRequest $request,Category $category)
    {
            $validated = $request->safe()->all();

            $category->language= $request->language;
            $category->name= $request->name;
            $category->slug=$request->slug;
            $category->show_at_nav = $request->show_at_nav;
            $category->status= $request->status;
            $category->update();
            return new AdminCatResource($category);
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
