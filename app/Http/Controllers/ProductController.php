<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Photo;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =Product::all();         
        
        return view ('product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $usd_value=  $this->Convert();

        $categories_availables = Category::where("isAvailable","=","1")->where("isAvailable","=","2")->get();
       
        return view('product.create',['categories'=>$categories_availables,'dolar_value'=>$usd_value]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product=new Product(); 
        $parent_category = Category::where("id","=",request('select_category'))->first();
                               
       
        $product->code=request('code');
        $product->name=request('name');
        $product->description=request('description');
        $product->weight=request('weight');
        $product->price=request('price');       
        $product->category_id=request('select_category'); 
       
       $product->save();
             
        for($i=1;$i<=3;$i++) //3 photos
        {      
            $photos=new Photo();    

            if($request->hasFile('photo_product_'.$i))
            {  
                $photo='photo_product_'.$i;

                $file=$request->$photo;
                $file->move(public_path(). '/images',$file->getClientOriginalName()); //save in public directory
                $photos->foto=$file->getClientOriginalName();
                $photos->description=request('photo_product_'.$i.'_description');  
                $photos->product_id=$product->id;   
            
               $photos->save();                 
            }  
        }       
     
                
        if($parent_category!=null)
        {
            if($product->category_id==$parent_category->id)
            {
               $parent_category->isAvailable=2;
               $parent_category->update();
            }           
        }                
    
      
       return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     
        $categories = Category::all();   
        $photos=Photo::where("product_id","=",$id)->get();
        
        return view('product.show',['product'=>Product::findOrFail($id),'categories'=>$categories, 'photos'=>$photos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories =Category::where("isAvailable","=","1")->where("isAvailable","=","2")->get();//  0= is not available 1= available 2= used 3=delete

        $photos=Photo::where("product_id","=",$id)->get();

               
        return view('product.edit',['product'=>Product::findOrFail($id),'categories'=>$categories,'photos'=>$photos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $category=Category::where("id","=",request('select_category'))->first();;

       
        $product->code=request('code');
        $product->name=request('name');
        $product->description=request('description');
        $product->weight=request('weight');
        $product->price=request('price');       
        $product->category_id=request('select_category'); 

      
       
       $product->update();
             
        for($i=1;$i<=3;$i++) //3 photos
        {  
            $photos=Photo::where("id","=",request('photo_id_'.$i))->first();                              

            if($request->hasFile('photo_product_'.$i))
            {  
                $photo='photo_product_'.$i;

                $file=$request->$photo;
                $file->move(public_path(). '/images',$file->getClientOriginalName()); //save in public directory
                $photos->foto=$file->getClientOriginalName();
                $photos->description=request('photo_product_'.$i.'_description');                   
            
               $photos->update();                 
            } 
        }  
     
                
        if($category!=null)
        {
            if($product->category_id==$category->id)
            {
               $category->isAvailable=2;
               $category->update();
            }           
        }              
    

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();

        return redirect('products');
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Convert()
    {

       return  "3650.2";

       /* $access_key  = '4bce3c30c16e1a56d50114e6241b0337';
       
        $url="http://api.currencylayer.com/live?access_key=4bce3c30c16e1a56d50114e6241b0337&currencies=USD,COP";

        $json = json_decode(file_get_contents($url), true);


        $usd_value= $json['quotes']['USDCOP'];     
        
        return $usd_value;*/

    }
}
