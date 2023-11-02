<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminHomeSectionResource;
use App\Models\HomeSectionSetting;
use Illuminate\Http\Request;
use Response;
use Route;

class AdminHomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdminHomeSectionResource::collection(HomeSectionSetting::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $section = HomeSectionSetting::create([
        //     'language'=> $request->language,
        //     'category_section_one'=>$request->category_section_one,
        //     'category_section_two' =>$request->category_section_two,
        //     'category_section_three'=>$request->category_section_three,
        //     'category_section_four'=>$request->category_section_four
        // ]);


        $section = HomeSectionSetting::updateOrCreate(
            ['language'=>$request->language],
            [
                'category_section_one' => $request->category_section_one,
                'category_section_two'=>$request->category_section_two,
                'category_section_three' => $request->category_section_three,
                'category_section_four'=>$request->category_section_four,
            ]

        );

        return new AdminHomeSectionResource($section);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(HomeSectionSetting $section)
    {
            $section->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
