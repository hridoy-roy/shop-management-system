<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Treat\PurchaseReturnId;
use App\Treat\Repeater;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PurchaseReturn extends Component
{
    use Repeater, PurchaseReturnId;

    public $product_id;
    public $price;
    public $singlePrice;
    public $quantity;
    public array $productunit = [null];
    public array $productCategory = [null];
    public array $total = [0];
    public $finalTotal;
    public $totalQty;
    public $productAvailable;

    protected $rules = [
        'product_id.*' => 'required',
        'price.*' => 'required|integer',
        'quantity.*' => 'required',
    ];


    public function updated($name, $value)
    {
        $this->validateOnly($name);

        if (str_starts_with($name, 'product_id.')) {
            $nameKey = explode(".", $name);
            $product = Product::withSum('stock as total_in', 'product_in')
                ->withSum('stock as total_out', 'product_out')
                ->find($value);
            $this->productunit[$nameKey[1]] = $product->unit_name;
            $this->productCategory[$nameKey[1]] = $product->category->name;
            $this->productAvailable[$nameKey[1]] = $product->total_in - $product->total_out;
        }
        if (str_starts_with($name, 'price.')) {
            $nameKey = explode(".", $name);
            $this->singlePrice = $value;
            $this->finalTotal = array_sum($this->total);
        }
        if (str_starts_with($name, 'quantity.')) {
            $nameKey = explode(".", $name);
            $this->total[$nameKey[1]] = $this->singlePrice * $value;
            $this->finalTotal = array_sum($this->total);
            $this->totalQty = array_sum($this->quantity);
        }
    }


    public function submit()
    {
        try {
            DB::beginTransaction();
            $purchase = \App\Models\PurchaseReturn::create([
                'purchase_return_num' => $this->PurchaseReturnId(),
                'amount' =>  $this->finalTotal,
                'created_by' => \Auth::user()->name,
            ]);
            $purchase->purchaseReturnDetails()->createMany($this->purchaseReturnDetails($this->validate()));
            DB::commit();
            $this->reset();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->reset();
            report($e);
            toastr()->error('Data Not saved successfully!');
            return redirect()->back();
        }

        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }


    public function purchaseReturnDetails(array $data): array
    {
        $data['product_id'] = data_get($data, 'product_id.*');
        $data['price'] = data_get($data, 'price.*');
        $data['quantity'] = data_get($data, 'quantity.*');

        for ($i = 0; $i < count($data['product_id']); $i++) {
            $purchaseDetails[] = [
                'product_id' => $data['product_id'][$i],
                'rate' => $data['price'][$i],
                'qty' => $data['quantity'][$i],
                'amount' => $data['price'][$i] * $data['quantity'][$i],
            ];
        }

        return $purchaseDetails ?? [];
    }
    public function render()
    {
        $data = [
            'subTitle' => 'Purchase',
            'title' => 'Purchase',
            'products' => Product::where('status', 1)->get(),
            'purchaseReturnId' => $this->PurchaseReturnId(),
        ];
        return view('livewire.purchase-return', $data);
    }
}
