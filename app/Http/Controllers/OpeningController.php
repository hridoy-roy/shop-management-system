<?php

namespace App\Http\Controllers;

use App\Models\Opening;
use App\Http\Requests\StoreOpeningRequest;
use App\Http\Requests\UpdateOpeningRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;

class OpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Opening',
            'subTitle' => 'Opening Info',
            'products' => Product::latest()->take(200)->get(),
            'categories' => ProductCategory::latest()->take(200)->get(),
            'openings' => Opening::get(),
        ];
        return view('opening.create', $data);
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
     * @param  \App\Http\Requests\StoreOpeningRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreOpeningRequest $request): RedirectResponse
    {
        Opening::create(array_merge($request->validated(), ['created_by' => \Auth::user()->name]));
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function show(Opening $opening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function edit(Opening $opening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOpeningRequest  $request
     * @param  \App\Models\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpeningRequest $request, Opening $opening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opening $opening)
    {
        //
    }
}
