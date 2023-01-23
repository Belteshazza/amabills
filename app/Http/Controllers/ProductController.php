<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProductController extends Controller
{
    public function createProduct(Request $request){

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'int'],
            'unit_price' => ['required', 'int'],
            'amount' => ['required', 'int']
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->unit_price = $request->unit_price;
        $product->amount = $request->amount;
       

        if(Auth::id()){
       
        $product->user_id = Auth::user()->id;   
        }

        $product->save();

        return response()->json([
            'message' => 'Congratulations You have Successfully created a product',
            'product' => $product
        ]);

    }


    public function allProduct() {

        $allProduct = Product::orderBy('created_at', 'desc')->paginate(2);        
        
        return response()->json([
            'message'=>'successful',
            'allProduct' => $allProduct
           
        ], 200);
    }

    public function updateProduct(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'int'],
            'unit_price' => ['required', 'int'],
            'amount' => ['required', 'int']
        ]);

        $product = Product::where('id', $id)->first();

        if(auth()->user()->id === $product->user_id){        

        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->unit_price = $request->unit_price;
        $product->amount = $request->amount;

        $product->save();
        
        return response()->json([
            'message' => 'Congratulations You have Successfully updated a product',
            'data' => $product,
        ]);

        }else {

            return response()->json(['message'=>'You do not own this product,so can not update it'], 401);
        }

    }

    public function deleteProduct(Request $request, $id){

        $product = Product::where('id', $id)->first();

        if(auth()->user()->id === $product->user_id){        

        $product->delete();
        
        return response()->json([
            'message' => 'Congratulations You have Successfully deleted a product',
    
        ]);

        }else {

            return response()->json(['message'=>'You do not own this product,so can not delete it'], 401);
        }

    }

    

}