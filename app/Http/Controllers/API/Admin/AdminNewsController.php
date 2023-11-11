<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Http\Resources\Admin\AdminNewsResource;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminNewsController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $result = News::where('language' ,request('lang' , 'en'))->where('auther_id', auth()->id())->with('category')->paginate(10);

        return AdminNewsResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {

        $request->safe()->all();
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

            $new_tag = Tag::firstOrCreate(['name'=>$tag,'language'=>$request->language]);

                $tagIds[] =  $new_tag->id;
        }


        $news->tags()->sync($tagIds);




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
    public function update(FormRequest $request , News $news)
    {

        if($news->auther_id != auth()->id())
        {
            return response()->json([
                'message'=>'error you dont have permision',
            ]);
        }

        $request->safe()->all();

        $news->language = $request->language;
        $news->category_id =  $request->category;
        $news->auther_id = Auth::user()->id;
        $news->image = !empty($request->image) ? $request->image: $news->image;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;

        $news->is_breaking_news = $request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular = $request->show_at_popular == 1 ? 1 : 0;
        $news->status = $request->status == 1 ? 1 : 0;
        $news->save();

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tag) {


            $new_tag = Tag::firstOrCreate(['name'=>$tag,'language'=>$request->language]);

                $tagIds[] =  $new_tag->id;

        }

        $news->tags()->sync($tagIds);

        return new AdminNewsResource($news);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if($news->auther_id != auth()->id())
        {
            return response()->json([
                'msg'=>'error',
            ]);
        }

        $this->deleteFile($news->image);
        $news->delete();
        return response()->json([
            'message'=>'News was deleted'
        ]);
    }
}
