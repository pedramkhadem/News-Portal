<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminLangResource;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminLangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdminLangResource::collection(Language::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'=>['required' , 'max:255'],
            'lang'=>['required' , 'max:255' ,'unique:languages,lang'],
            'slug'=>['required' ,'max:255' , 'unique:languages,slug'],
            'default'=>['required', 'boolean'],
            'status'=>['required' , 'boolean']
        ]);

        //if validator is fails
        if($validate->fails()){
            return response()->json([
                'message'=>$validate->errors()->first(),
            ], 400);
        }

        $language = new Language();
        $language->name = $request->name;
        $language->lang = $request->lang;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;

        $language->save();

        return new AdminLangResource($language);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return new AdminLangResource($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Language $language)
    {
        $validate = Validator::make($request->all(), [
            'name'=>['required' , 'max:255'],
            'lang'=>['required' , 'max:255' ,'unique:languages,lang'],
            'slug'=>['required' ,'max:255' , 'unique:languages,slug'],
            'default'=>['required', 'boolean'],
            'status'=>['required' , 'boolean']
        ]);

        //if validator is fails
        if($validate->fails()){
            return response()->json([
                'message'=>$validate->errors()->first(),
            ], 400);
        }

        $language->update($request->all());

        return new AdminLangResource($language);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
         $language->delete();
         return response()->json([
            'message'=>'Language was deleted'
        ]);


    }
}
