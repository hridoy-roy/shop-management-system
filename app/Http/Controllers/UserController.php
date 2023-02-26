<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'title' => 'User Manage',
            'subTitle' => 'User Manage System',
            'users' => User::where('is_admin', 0)->get(),
        ];
        return view('user_manage.index', $data);
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
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        if ($request->file('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $filename = date('YmdHi') . '.' . $extension;
            $image = $request->file('avatar')->move('shop/user/', $filename);
            $avatar = 'shop/user/' . $filename;
        }
        User::create(array_merge($request->validated(), ['avatar' => $avatar ?? null,'password' => Hash::make(12345678),'created_by' => \Auth::user()->name]));
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'User Edit',
            'subTitle' => 'User Edit System',
            'user' => $user,
        ];
        return view('user_manage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserStoreRequest $request,User $user): RedirectResponse
    {

        if ($request->file('avatar')) {
            if ($user->avatar) {
                File::delete($user->avatar);
            }

            $extension = $request->file('avatar')->getClientOriginalExtension();

            $filename = date('YmdHi') . '.' . $extension;
            $image = $request->file('avatar')->move('shop/user/', $filename);
            $avatar = 'shop/user/'.$filename;
        }
        $user->update(array_merge($request->validated(), ['avatar' => $avatar ?? null,'updated_by' => \Auth::user()->name]));
        toastr()->success('Data has been Updated successfully!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(User $user): bool
    {
        return $user->delete();
    }

    public function userDeleted(): Factory|View|Application
    {
        $data = [
            'title' => 'Deleted User',
            'subTitle' => 'Deleted User Manage',
            'users' => User::onlyTrashed()->where('is_admin', 0)->get(),
        ];
        return view('user_manage.deleted_user', $data);
    }

}
