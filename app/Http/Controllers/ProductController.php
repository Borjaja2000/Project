<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;


        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('../resources/assets');
            $product->photo = $path;
        }

        $product->save();

        return redirect()->route('products.index');
    }
}
