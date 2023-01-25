<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProductController extends Controller
{

     /**
     * create products end point
     */

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

     /**
     * list all product with pagination and in DESC order
     */

    public function allProduct() {

        $userid = auth()->user()->id;
        $product = Product::where('user_id', $userid)->orderBy('created_at', 'desc')->paginate(2);

        return response()->json([
            'message'=>'successful',
            'data' =>  $product
           
        ], 200);        
    }

    /**
     *   update Products created by owner of the products only
     */

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

    /**
     *   Delete Products created by owner of the products only
     */

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