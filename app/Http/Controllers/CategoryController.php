<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = \App\Models\Category::paginate(10);

   

    return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
    
        $new_category = new \App\Models\Category;
        $new_category->name = $name;
    
        if($request->file('image')){
    
            $image_path = $request->file('image')
                    ->store('category_images', 'public');
    
            $new_category->image = $image_path;
        }
    
        $new_category->created_by = \Auth::user()->id;
    
    
        $new_category->save();
    
        return redirect()->route('categories.index')->with('status', 'Category successfully created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $category_to_edit = \App\Models\Category::findOrFail($id);
    
        return view('categories.edit', ['category' => $category_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $name = $request->get('name');
    
        $category = \App\Models\Category::findOrFail($id);
    
        $category->name = $name;
    
        if($request->file('image')){
            if($category->image && file_exists(storage_path('app/public/' . $category->image))){
                \Storage::delete('public/' . $category->name);
            }
    
            $new_image = $request->file('image')->store('category_images', 'public');
    
            $category->image = $new_image;
        }
    
        $category->updated_by = \Auth::user()->id;
    
    
        $category->save();
    
        return redirect()->route('categories.index', [$id])->with('status', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $category = \App\Models\Category::findOrFail($id);
      
        $category->delete();
      
        return redirect()->route('categories.index')
        ->with('status', 'Category successfully moved to trash');
      }
      
}
