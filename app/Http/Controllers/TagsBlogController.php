<?php

namespace App\Http\Controllers;

use App\Models\TagsBlog;
use Illuminate\Http\Request;
use Validator;

class TagsBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $tags= TagsBlog::orderBy('id','desc')->get();
        if ($tags){
        return response()->json($tags);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:tags_blogs|between:2,30',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tag = TagsBlog::create(array_merge(
                    $validator->validated()
                ));
        return response()->json([
           'tag'=>$tag
        ],201);

         // return response()->json([
         //                'success'=>true,
         //                'tags'=>$tags,
         //                'message'=>'Saved'
         //            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TagsBlog  $tagsBlog
     * @return \Illuminate\Http\Response
     */
    public function show(TagsBlog $tagsBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TagsBlog  $tagsBlog
     * @return \Illuminate\Http\Response
     */
    public function edit(TagsBlog $tagsBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagsBlog  $tagsBlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagsBlog $tagsBlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagsBlog  $tagsBlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagsBlog $tagsBlog)
    {
        //
    }
}
