<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class NewsController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.news.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        $categories = Category::all();
        return view('admin.news.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {
        /** Handle Image */
        $image_path = $this->handleFileUpload($request, 'image');
        $news = new News();
        $news->language = $request->language;
        $news->category_id =  $request->category;
        $news->auther_id = Auth::guard('admin')->user()->id;
        $news->image = $image_path;
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


        toast(__('Created Successfully!'), 'success')->width('400');

        return redirect()->withInput()->route('admin.news.index');
    }

    /**
     * Change toggle status.
     */
    public function toggleNewsStatus(Request $request)
    {

        try {
            $news = News::findOrFail($request->id);
            $news->{$request->name} = $request->status;
            $news->save();

            return response(['status' => 'success', 'message' => __('Updated successfuly')]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all();
        $news = News::findOrFail($id);
        $categories = Category::where('language', $news->language)->get();

        return view('admin.news.edit', compact('languages', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminNewsUpdateRequest $request, string $id)
    {


        $news = News::findOrFail($id);

        /** Handle Image */
        $image_path = $this->handleFileUpload($request, 'image');
        $news->language = $request->language;
        $news->category_id =  $request->category;
        $news->auther_id = Auth::guard('admin')->user()->id;
        $news->image = !empty($image_path) ? $image_path : $news->image;
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
        /**delete previos tags */
        $news->tags()->delete();

        /**detach tags from pivot  tables*/
        $news->tags()->detach($news->tags);


        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->language = $news->language;
            $item->save();

            $tagIds[] = $item->id;
        }
        $news->tags()->attach($tagIds);


        toast(__('Updated Successfully!'), 'success')->width('400');

        return redirect()->route('admin.news.index');
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news =  News::findOrFail($id);
        $this->deleteFile($news->image);
        $news->tags()->delete();
        $news->delete();

        return response(['status' => 'success' , 'message' =>__('Deleted File Successfuly ! ')]);
    }

    /**
     * Fetch category depending on language
     */
    public function fetchCategory(Request $request)
    {

        $categories = Category::where('language', $request->lang)->get();
        return $categories;
    }

    /**
     * copy news
     */

    public function copyNews(string $id)
    {
        $news = News::findOrFail($id);
        $copyNews = $news->replicate();
        $copyNews->save();

        toast(__('Copied News Successfuly') , 'success');
        return redirect()->back();
    }










}
