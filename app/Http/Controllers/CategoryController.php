<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryEditRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::all();

        return view ('category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::where("isAvailable","=",0)->where("isAvailable","=",1)->get();//  0= is not available 1= available 2= used 3= deleted
       
        return view('category.create',['parents'=>$parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $category=new Category();  
        
        $parent=request('select_parent');

       
        $parent_category = Category::where("code","=",request('select_parent'))->first();  
       

        $category->code=request('code');
        $category->name=request('name');

        if($request->hasFile('photo'))
        {
            $file=$request->photo;
            $file->move(public_path(). '/images',$file->getClientOriginalName());
        }

        $category->photo=$file->getClientOriginalName();       
        $category->isAvailable=1;
        $category->parentID=request('select_parent');    


        if($parent_category!=null)
        {
            if($category->parentID==$parent_category->code)
            {
                $parent_category->isAvailable=0;
                $parent_category->update();
            }           
        }           

       
      $category->save();
      return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parents = Category::all();
        
        return view('category.show',['category'=>Category::findOrFail($id),'parents'=>$parents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = Category::where("isAvailable","=",0)->where("isAvailable","=",1)->get();;//  0= is not available 1= available 2= used 3= delete
        
        return view('category.edit',['category'=>Category::findOrFail($id),'parents'=>$parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryEditRequest $request, $id)
    {
        $category=Category::findOrFail($id);

        $category->name=$request->get('name');       

        if($request->hasFile('photo'))
        {
            $file=$request->photo;
            $file->move(public_path(). '/images',$file->getClientOriginalName());  
            $category->photo=$file->getClientOriginalName();             
       
        }

        $category->parentID=$request->get('select_parent');
                     
        $category->update();

        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);

        $category->isAvailable=3;
        $category->update();

        return redirect('categories');

    }

   
}
