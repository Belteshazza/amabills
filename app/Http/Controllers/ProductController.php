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
            'appointment' => $product
        ]);

    }
}
