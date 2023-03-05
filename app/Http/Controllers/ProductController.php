<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Product::where('category_id', 0)->orderBy('name')->get(['id', 'name']);
        $products = DB::select('SELECT 
                                    a.id,
                                    a.name,
                                    a.description,
                                    (SELECT b.name 
                                     FROM products b
                                     WHERE a.category_id=b.id
                                    ) AS category
                                FROM products a
                                WHERE a.category_id<>0');

        return view('product.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'category_id' => $request->category,
            'name'        => $request->product,
            'description' => $request->description
        ]);

        return redirect()->route('products.index')->with("message", "Продукт успешно создан.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Product::where('category_id', 0)->orderBy('name')->get(['id', 'name']);
        
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $date = date('Y-m-d H:i:s');
        Product::where('id', $id)->update([
            'category_id' => $request->update_category,
            'name'        => $request->update_product,
            'description' => $request->update_description,
            'updated_at'  => $date
        ]);

        return redirect()->route('products.index')->with('message', 'Продукт успешно сохранен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('products.index')->with('message', 'Продукт удален');
    }
}
