<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Photo;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        // $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(6);
       return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create',Product::class);

      $product =  Product::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'text'=>$request->text,
            'price'=>$request->price,
        ]);


        if($request->file('photo')){
            $path = $request->file('photo')->store('product-photos');
            $product->photos()->create(['url'=> $path]);
          }
        

        return $this->success('product created', $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->response(new ProductResource($product));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    { 
         $this->authorize('update', $product); 


        //  if($request->hasFile('photo')){
        //  if(isset($post->photos()->get()[0]->url)){
        //     Storage::delete($post->photos()->get()[0]->url);
        //     $post->photos()->delete();
        // }
        //     $path = $request->file('photo')->store('post-photos');
        //     $post->photos()->create(['url'=> $path]);
        //   }
        $product->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'text'=>$request->text,
            'price'=>$request->price,
        ]);

    
        
        return $this->success('product updated', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if(isset($product->photos()->get()[0]->url)){
            Storage::delete($product->photos()->get()[0]->url);
            $product->photos()->delete();
        }
        
        $product->delete();
     
        return $this->success('product deleted', $product);
    }
}
