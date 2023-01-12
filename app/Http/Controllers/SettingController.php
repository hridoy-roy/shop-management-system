<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'title' => 'Setting',
            'subTitle' => 'Setting View',
        ];
        return view('settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $data = [
            'title' => 'Setting',
            'subTitle' => 'Setting Create',
        ];
        return view('settings.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSettingRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSettingRequest $request): RedirectResponse
    {
        foreach ($request->validated() as $key => $value) {

            if ($request->file($key)) {
                if (Setting::where('key', $key)->first()->value) {
                    File::delete(Setting::where('key', $key)->first()->value);
                }

                $extension = $request->file($key)->getClientOriginalExtension();

                $filename = date('YmdHi') . '.' . $extension;
                $image = $request->file($key)->move('shop/logo/', $filename);
                $value = 'shop/logo/'.$filename;
            }

            Setting::updateOrCreate([
                'key' => $key,
            ], [
                'key' => $key,
                'value' => $value,
            ]);
        }
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Setting $setting
     * @return Application|Factory|View
     */
    public function edit(Setting $setting): Application|Factory|View
    {
        $data = [
            'title' => 'Setting',
            'subTitle' => 'Setting Edit',
        ];
        return view('settings.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSettingRequest $request
     * @param \App\Models\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
