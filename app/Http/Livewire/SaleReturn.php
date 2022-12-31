<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Product;
use App\Treat\Repeater;
use App\Treat\SaleReturnId;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SaleReturn extends Component
{
    use Repeater, SaleReturnId;

    public $product_id;
    public $price;
    public $singlePrice;
    public $quantity;
    public array $productunit = [null];
    public array $productCategory = [null];
    public array $total = [0];
    public $customer_id;
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
            $sale = \App\Models\SaleReturn::create([
                'sale_return_num' => $this->SaleReturnId(),
                'customer_id' => $this->customer_id,
                'amount' =>  $this->finalTotal,
                'created_by' => \Auth::user()->name,
            ]);
            $sale->saleReturnDetails()->createMany($this->saleReturnDetails($this->validate()));
            DB::commit();
            $this->reset();
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
            toastr()->error('Data Not saved successfully!');
            $this->reset();
            return redirect()->back();
        }
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }


    public function saleReturnDetails(array $data): array
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
            'subTitle' => 'Sale Return Create',
            'title' => 'Sale Return',
            'products' => Product::where('status', 1)->get(),
            'saleReturnId' => $this->SaleReturnId(),
            'customers' => Customer::where('status', 1)->get(),
        ];
        return view('livewire.sale-return', $data);
    }
}
