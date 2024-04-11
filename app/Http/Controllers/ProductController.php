<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;  


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

        try {

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
        } catch (QueryException $e) {
            return redirect()->route('product')->with('success', 'Erreur, il y a un souci.');
        }
    }

    public function edit(Request $request)
    {
       try {
           
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
                  return redirect()->route('product')->with('success', 'Product modifié avec succès.');
              }else{
                return;
              }

       } catch (QueryException $e) {
            return redirect()->route('product')->with('success', 'Erreur, il y a un souci.');
            
       }
    
    }

    public function delete(Request $request)
    {
       try {
           
           $validator = Validator::make($request->all(), [
            'delete_id' => 'bail|required',
           ]);
 
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $products = Product::where('id',$request->delete_id)
                              ->delete();
          
            if ($products) {
                return redirect()->route('product')->with('success', 'Product supprimé avec succès.');

            }else{
                return;
            }

       } catch (QueryException $e) {
            return redirect()->route('product')->with('success', 'Erreur, il y a un souci.');
           
       }
    
    }


}
