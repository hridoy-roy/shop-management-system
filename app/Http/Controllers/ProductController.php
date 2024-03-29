<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Product',
            'subTitle' => 'Product Info',
            'products' => Product::latest()->take(200)->get(),
            'categories' => ProductCategory::latest()->take(200)->get(),
        ];
        return view('products.create', $data);
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
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        Product::create(array_merge($request->validated(), ['created_by' => \Auth::user()->name]));
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $data = [
            'title' => 'Product',
            'subTitle' => 'Product Info',
            'products' => Product::latest()->take(200)->get(),
            'categories' => ProductCategory::latest()->take(200)->get(),
            'product' => $product,
        ];
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return RedirectResponse
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update(array_merge(
            $request->validated(),
            ['updated_by' => \Auth::user()->name]
        ));

        toastr()->success('Data has been Updated successfully!');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $destroy = $product->delete();
        if ($destroy) {
            toastr()->success('Data has been Deleted successfully!');
        } else {
            toastr()->error('Data Not Delete!');
        }
        return redirect()->route('products.index');
    }
}
