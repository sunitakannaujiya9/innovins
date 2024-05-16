<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('deleted_at', null)->get();
        if($products->count() > 0){
            return response()->json([
                'status'=>200,
                'products'=>$products
            ], 200);
        }else{
            return response()->json([
                'status'=>4404,
                'products'=>'No Record Found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ], 422);
        }
            $product = Product::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'price'=>$request->price

            ]);

            if($product){
                return response()->json([
                    'status'=>200,
                    'message'=>"Product created successfully"
                ], 200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Something went wrong"
                ], 500);
            }
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->where('deleted_at', null)->first();

        if($product){
            return response()->json([
                'status'=>200,
                'product'=>$product
            ], 200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Product Found!"
            ], 404);
        }
    }


    public function edit($id){

        $product = Product::where('id', $id)->where('deleted_at', null)->first();

        if($product){
            return response()->json([
                'status'=>200,
                'product'=>$product
            ], 200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Product Found!"
            ], 404);
        }

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ], 422);
        }
        

            $product = Product::where('id', $id)->where('deleted_at', null)->first();

            if($product){

                $product->update([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'price'=>$request->price
    
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>"Product Updated successfully"
                ], 200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>"No Such Product Found!"
                ], 404);
            }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->where('deleted_at', null)->first();
        
        if($product){
            $product->delete();

            return response()->json([
                'status'=>200,
                'message'=>"Product Deleted successfully"
            ], 200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Product Found!"
            ], 404);
        }
    }
}
