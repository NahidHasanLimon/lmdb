<?php

namespace App\Http\Controllers;

use App\Models\CategoriesBlog;
use Illuminate\Http\Request;
use Validator;
class CategoriesBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags= CategoriesBlog::orderBy('id','desc')->get();
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
        // return 'good';
        $input= [
            'name' => $request->name,
            'icon' => $request->iconName,
        ];
        // var_dump($input);
        // return $request->iconName;
         $validator = Validator::make($input, [
            'name' => 'required|string|unique:categories_blogs|between:2,30',
            'icon' => 'required|string|unique:categories_blogs',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
         $category = CategoriesBlog::create(array_merge(
                    $validator->validated()
                ));
        return response()->json([
           'category'=>$category
        ],201);
    }
    public function uploadIcon(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
         $imageName = time().'.'.$request->file->extension();
         $upload = $this->uploadToServer($request->file,$imageName);
         if ($upload) {
         return response()->json('images/categories/'.$imageName,200);
         }else{
            return response()->json('Failed to Upload',500);
         }

    }
    public function uploadToServer($requestedFile,$imageName){
        // var_dump($requestedFile);
        $upload = $requestedFile->move(public_path('images/categories'), $imageName);
        if (!$upload) {
            return false;
        }else{
            return true;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesBlog  $categoriesBlog
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesBlog $categoriesBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesBlog  $categoriesBlog
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesBlog $categoriesBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesBlog  $categoriesBlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesBlog $categoriesBlog)
    {
         $input= [
            'name' => $request->name,
            'icon' => $request->iconName,
        ];
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'icon' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $old_icon = CategoriesBlog::find($request->id)->icon;
        // var_dump($old_icon);
        // var_dump($input['icon']);
        // $old_icon = $category->icon;
        // var_dump($old_icon);
        if ($old_icon!=$input['icon']){
          // icon upload and delete previous one
            $this->deleteFromServer($old_icon);
            // $category->icon = $input['icon'];
            // and assign new icon for database
        }

        // // var_dump($old_icon);
        $category = CategoriesBlog::where('id',$request->id)->update([
            'name'=> $input['name'],
            'icon'=> $input['icon'],
        ]);
        if ($category){
            $category = CategoriesBlog::find($request->id);
            return response()->json([
           'category'=>$category
        ],201);
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesBlog  $categoriesBlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $category = CategoriesBlog::find($request->id);
        if (!$category) {
              return response()->json(
               'ID Not Found', 400);
        }
        $iconName = $category->icon;
         $category->delete();
         $deleteIcon= $this->deleteFromServer($iconName);
           return response()->json([
           'category'=>$category
        ],200);

   
    }
    public function deleteFromServer($fileName)
    {
        // $filePath = public_path().'/images/categories/'.$fileName;
        // $path = public_path()."/uploads/".$from_db->image_name;
        $filePath = public_path().'/'.$fileName;
        // var_dump($filePath);
        if (file_exists($filePath)) {
           @unlink($filePath);
           return true;
        }else{
            return false;
        }
        
    }
    public function deleteIcon(Request $request)
    {
        //
        $iconName = $request->icon;
        $deleteIcon = $this->deleteFromServer($iconName);
        if ($deleteIcon) {
            return response()->json([
            'icon'=>$iconName
        ]);
        }else{
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
}
