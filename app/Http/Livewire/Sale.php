<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Treat\Repeater;
use App\Treat\SaleId;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sale extends Component
{
    use Repeater, SaleId;

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
            $product = Product::find($value);
            $this->productunit[$nameKey[1]] = $product->unit_name;
            $this->productCategory[$nameKey[1]] = $product->category->name;
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
            $sale = \App\Models\Sale::create([
                'sale_num' => $this->SaleId(),
                'created_by' => \Auth::user()->name,
            ]);
            $sale->saleDetails()->createMany($this->saleDetails($this->validate()));
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


    public function saleDetails(array $data): array
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
            'subTitle' => 'Sale Info',
            'title' => 'Purchase',
            'products' => Product::where('status', 1)->get(),
            'saleId' => $this->saleId(),
        ];
        return view('livewire.sale', $data);
    }
}
