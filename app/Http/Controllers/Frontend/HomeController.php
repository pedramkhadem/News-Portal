<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breakingnews = News::where([
            'status'=> 1,
            'is_approved'=>1,
            'is_breaking_news'=> 1
        ])->get();

        $heroSlider = News::with(['category'])
        ->where('show_at_slider' , 1)
        ->orderBy('id' , 'DESC')->take(7)
        ->get();

        $recentNews = News::with(['category'])->orderBy('id' , 'DESC')->take(6)->get();

        $popularNews = News::with(['category'])
        ->where('show_at_popular' , 1)
        ->orderBy('updated_at' , 'DESC')
        ->take(4)->get();


        return view('frontend.home' , compact('breakingnews' , 'heroSlider' , 'recentNews' ,'popularNews'));

    }
}
