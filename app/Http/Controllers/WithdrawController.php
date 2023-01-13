<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use App\Http\Requests\StoreWithdrawRequest;
use App\Http\Requests\UpdateWithdrawRequest;
use App\Treat\WithdrawId;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Http\Response;

class WithdrawController extends Controller
{
    use WithdrawId;
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'subTitle' => 'Withdraw list',
            'title' => 'Withdraw',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'withdraws' => Withdraw::where('type','Withdraw')
                ->whereDate('date','>=',date('Y-m-01'))
                ->whereDate('date','<=',now('Asia/Dhaka'))->latest()->get(),
        ];
        return view('withdraw.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $data = [
            'title' => 'Withdraw',
            'subTitle' => 'Withdraw Create',
            'withdraw_num' => $this->withdrawId(),
        ];
        return view('withdraw.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWithdrawRequest  $request
     * @return RedirectResponseAlias
     */
    public function store(StoreWithdrawRequest $request)
    {
        Withdraw::create(array_merge($request->validated(), ['withdraw_num' => $this->withdrawId(),'created_by' => \Auth::user()->name]));
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return Application|Factory|View
     */
    public function edit(Withdraw $withdraw): Application|Factory|View
    {
        $data = [
            'title' => 'Withdraw',
            'subTitle' => 'Withdraw Edit',
            'withdraw' => $withdraw,
        ];
        return view('withdraw.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreWithdrawRequest  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return RedirectResponseAlias
     */
    public function update(StoreWithdrawRequest $request, Withdraw $withdraw): RedirectResponseAlias
    {
        $withdraw->update(array_merge(
            $request->validated(),
            ['updated_by' => \Auth::user()->name]
        ));
        toastr()->success('Data has been Updated successfully!');
        return redirect()->route('withdraw.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return bool
     */
    public function destroy(Withdraw $withdraw): bool
    {
        return $withdraw->delete();
    }

    public function holdList()
    {
        $data = [
            'subTitle' => 'Withdraw Hold list',
            'title' => 'Withdraw Hold',
            'withdraws' => Withdraw::where('type','Withdraw_Hold')->latest()->get(),
        ];
        return view('withdraw.hold_list', $data);
    }

    public function holdConfirm($id)
    {
        return Withdraw::find($id)->update(['type' => 'Withdraw']);
    }
}
