<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        $data = [
            'subTitle' => 'Product Category',
            'title' => 'Categories Info',
            'categories' => ProductCategory::latest()->take(200)->get(),
        ];
        return view('categories.create', $data);
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
     * @param \App\Http\Requests\StoreProductCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create(array_merge($request->validated(), ['created_by' => \Auth::user()->name]));
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        $data = [
            'subTitle' => 'Product Category Edit',
            'title' => 'Categories Info Edit',
            'categories' => ProductCategory::latest()->take(200)->get(),
            'category' => $category,
        ];
        return view('categories.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductCategoryRequest $request
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductCategoryRequest $request, ProductCategory $category)
    {
        $category->update(array_merge(
            $request->validated(),
            ['updated_by' => \Auth::user()->name]
        ));

        toastr()->success('Data has been Updated successfully!');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category,)
    {
        $destroy = $category->delete();
        if ($destroy) {
            toastr()->success('Data has been Deleted successfully!');
        } else {
            toastr()->error('Data Not Delete!');
        }
        return redirect()->route('categories.index');
    }
}
