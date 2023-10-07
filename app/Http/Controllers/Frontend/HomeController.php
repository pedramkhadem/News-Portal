<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\HomeSectionSetting;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $breakingnews = News::where(['is_breaking_news'=> 1])->activeEntries()->withLocalize()->orderBy('id', 'DESC')->take(10)->get();

        $heroSlider = News::with(['category'])
        ->where('show_at_slider' , 1)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'DESC')->take(7)
        ->get();

        $recentNews = News::with(['category', 'auther'])->activeEntries()->withLocalize()->orderBy('id' , 'DESC')->take(6)->get();

        $popularNews = News::with(['category'])
        ->where('show_at_popular' , 1)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('updated_at' , 'DESC')
        ->take(4)->get();
        $HomeSectionSetting = HomeSectionSetting::where('language', getLanguage())->first();

        $CategorySectionOne = News::where('category_id' , $HomeSectionSetting->category_section_one)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'DESC')
        ->take(8)
        ->get();

        $CategorySectionTwo = News::where('category_id' , $HomeSectionSetting->category_section_two)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'DESC')
        ->take(8)
        ->get();

        $CategorySectionThree = News::where('category_id' , $HomeSectionSetting->category_section_three)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'DESC')
        ->take(6)
        ->get();

        $CategorySectionFour = News::where('category_id' , $HomeSectionSetting->category_section_four)
        ->activeEntries()->withLocalize()
        ->orderBy('id' , 'DESC')
        ->take(4)
        ->get();

        $mostViewedNews = News::activeEntries()->withLocalize()->orderBy('views' , 'DESC')->take(3)->get();

        $mostCommenTags = $this->mostCommenTags();



        return view('frontend.home' , compact(
            'breakingnews' ,
             'heroSlider' ,
              'recentNews' ,
              'popularNews',
              'CategorySectionOne',
              'CategorySectionTwo',
              'CategorySectionThree',
              'CategorySectionFour',
              'mostViewedNews',
              'mostCommenTags',
        ));

    }

    public function shortLink()
    {
        $news = News::where('shortlink', url()->current())->get()->first();

        return $this->ShowNews($news->slug);

    }

    public function ShowNews(string $slug)
    {
        $news = News::with(['auther' , 'tags' , 'comments'])
        ->where('slug' ,$slug )
        ->activeEntries()->withLocalize()->first();
        $this->coutView($news);
        $recentNews = News::with(['category', 'auther'])->where('slug' ,'!=' , $news->slug)->activeEntries()->withLocalize()->orderBy('id' , 'DESC')->take(4)->get();
        $mostCommenTags = $this->mostCommenTags();
        $nextPost = News::where('id' , '>' , $news->id)->activeEntries()->withLocalize()->orderBy('id' , 'asc')->first();

        $previousPost = News::where('id', '<' , $news->id)->activeEntries()->withLocalize()->orderBy('id' , 'DESC')->first();
        $relatedPosts = News::where('slug' , '!=' ,$news->slug)
            ->where('category_id' ,$news->category_id)
            ->activeEntries()->withLocalize()
            ->take(5)
            ->get();

        return view('frontend.news-details' , compact('news' , 'recentNews' , 'mostCommenTags' , 'nextPost' , 'previousPost' , 'relatedPosts'));
    }

    public function coutView($news)
    {
        if(session()->has('viewed_posts')){
            $postIds = session('viewed_posts');

            if(!in_array($news->id ,$postIds)){
                $postIds[]=$news->id;
                $news->increment('views');
            }
            session(['viewed_posts'=> $postIds]);

        }else {
            session(['viewed_posts'=> [$news->id]]);
            $news->increment('views');
        }

    }

    public function mostCommenTags()
    {
        return Tag::select('name' ,\DB::raw('COUNT(*) as count'))
            ->where('language' , getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(15)
            ->get();
    }


    public function handleComment(Request $request)
    {

        $request->validate([
            'comment' => ['required' , 'string' , 'max:1000']
        ]);

        $comment = New Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();
        toast(__('Comment added successfuly') , 'success');

        return redirect()->back();
    }

    public function handleReply(Request $request)
    {
        $request->validate([
            'reply' => ['required' , 'string' , 'max:1000']
        ]);

        $comment = New Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->reply;
        $comment->save();
                toast(__('Comment added successfuly') , 'success');

        return redirect()->back();

    }

    public function commentDestroy(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if(Auth::user()->id === $comment->user_id){
            $comment->delete();
            return response(['status'=>'success' , 'message'=>'Deleted Successfuly !']);
        }
        return response(['status' =>'error' , 'message'=>'Somthing Was Wrong !']);

    }




}
