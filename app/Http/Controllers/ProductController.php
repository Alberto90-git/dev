<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('index',['products' => Product::get()]);
    }


    public function new()
    {
        return view('/templates/product/new');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'productName' => 'bail|required',
            'priceHt' => 'bail|required',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          $products = Product::create([
                    'name' => $request->productName,
                    'priceHt' => $request->priceHt,
                    'creationDate' =>  Carbon::now(),
          ]);
          


          if ($products) {
              return redirect()->to('product');
          }else{
            return;
          }
    }

    public function edit(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'id' => 'bail|required',
            'productName' => 'bail|required',
            'priceHt' => 'bail|required',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          $products = Product::where('id',$request->id)
                              ->update([
                                    'name' => $request->productName,
                                    'priceHt' => $request->priceHt,
                                    'dateUpdate' =>  Carbon::now(),
                              ]);
          
          if ($products) {
              return redirect()->to('product');
          }else{
            return;
          }
    
    }

    public function delete(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'id' => 'bail|required',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          $products = Product::where('id',$request->id)
                              ->delete();
          
          if ($products) {
              return redirect()->to('product');
          }else{
            return;
          }
    
    }





}
