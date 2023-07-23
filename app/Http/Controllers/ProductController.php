<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   
    public function index()

    {    //2 eme section refert to model
//compact('sections'): product is the variable

               $sections =section::all();
               $products=product::all();
      //compact take the variable with me to the page 
               return view('product.product',compact('sections','products'));

    }

  
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        product::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'Successfully Saved');
        return redirect('/product');
    }

   
    public function show(Product $product)
    {
        //
    }

    
    public function edit(Product $product)
    {
        //
    }

   
    public function update(Request $request)
    { $id = section::where('section_name', $request->section_name)->first()->id;

        $Products = product::findOrFail($request->pro_id);
 
        $Products->update([
        'Product_name' => $request->Product_name,
        'description' => $request->description,
        'section_id' => $id,
        ]);
        session()->flash('edit', 'The section has been updated successfully');
        return back();
    }

    
    public function destroy(Request $request)
    {
        $Products = product::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'The section has been deleted successfully');
        return back();
    }
}
