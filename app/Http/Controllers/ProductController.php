<?php

namespace App\Http\Controllers;
use App\Product;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code to display listing of products added
	$products = Product::all()->toArray();
	return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code to return the create product view
	return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //logic to store product in database
	$product = $this->validate(request(), [
		'name' => 'required',
		'price' => 'required|numeric'
	]);
	
	Product::create($product);
	return back()->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //code to return an  edit view for  an item
	$product = Product::find($id);
	return view('products.edit', compact('product', 'id'));
	
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
        //code to update product in the database
	$product = Product::find($id);
	$this->validate(request(), [
		'name' => 'required',
		'price' => 'required|numeric'
	]);
	$product->name = $request->get('name');
	$product->price = $request->get('price');
	$product->save();
	return redirect('products')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //code to remove product from database
	$product = Product::find($id);
	$product->delete();
	return redirect('products')->with('success', 'Product has been deleted');
    }
}
