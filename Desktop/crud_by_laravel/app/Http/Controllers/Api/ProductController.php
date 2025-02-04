<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
          $products = Product::get();
          if($products->count()>0)
          {
                return ProductResource::collection($products);
          }
          else
          {
            return response()->json(['massege'=>'no record available'],200);
          }
          
          
    }

    public function store( Request $request)
    {
          $validator = validator :: make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required', 
            'price' => 'required|integer'
          ]);

          if($validator->fails())
          {
            return response()->json([
              'message'=>'all fields are required',
               'errors'=>$validator->messages()
            ],422);
          }
         

          $product= Product::create([
            'name' => $request->name,
            'description' => $request->description, 
            'price' => $request->price
          ]);

          return response()->json([
             
            'message'=>'Product created successfully',
            'data'=> new ProductResource($product)

          ],200);
    }

    public function show(Product $product)
    {
         return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $validator = validator :: make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required', 
            'price' => 'required|integer'
          ]);

          if($validator->fails())
          {
            return response()->json([
              'message'=>'all fields are required',
               'errors'=>$validator->messages()
            ],422);
          }
         

          $product->update([
            'name' => $request->name,
            'description' => $request->description, 
            'price' => $request->price
          ]);

          return response()->json([
             
            'message'=>'Product updated successfully',
            'data'=> new ProductResource($product)

          ],200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
             
            'message'=>'Product deleted successfully'
          ],200);
    }
    
}
