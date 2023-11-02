<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Http\Resources\Admin\AdminNewsResource;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminNewsController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdminNewsResource::collection(News::with('category')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {
        /** Handle Image */


        // $image_path = $this->handleFileUpload($request, 'image');
        $news = new News();
        $news->language = $request->language;
        $news->category_id =  $request->category;
        $news->auther_id = Auth::user()->id;
        $news->image = $request->image;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->shortlink = url("/news",\Str::Random(6));
        $news->is_breaking_news = $request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular = $request->show_at_popular == 1 ? 1 : 0;
        $news->status = $request->status == 1 ? 1 : 0;
        $news->save();
        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->language = $news->language;
            $item->save();

            $tagIds[] = $item->id;
        }
        $news->tags()->attach($tagIds);



        return new AdminNewsResource($news);
    }



    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return new AdminNewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , News $news)
    {

        
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'language' => 'required',
            'content'=>'required' ,
            'meta_title' =>'required',
            "meta_description"=> 'required',
            'image'=>'required|max:3000',

        ]);

        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()->first(),
            ]);
        }

        $news->update($request->all());

        return new AdminNewsResource($news);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return response()->json([
            'message'=>'News was deleted'
        ]);
    }
}
