<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Treat\PurchaseId;
use App\Treat\Repeater;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Purchase extends Component
{
    use Repeater, PurchaseId;

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
        $validatedData = $this->validate();


        $this->purchseDetails($validatedData);

        try {
            DB::beginTransaction();
            $purchase = \App\Models\Purchase::create([
                'purchase_num' => $this->purchaseId(),
            ]);
            $purchase->purchaseDetails()->createMany($this->purchseDetails($validatedData));
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
            toastr()->error('Data Not saved successfully!');
            return redirect()->back();
        }

        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }


    public function purchseDetails(array $data): array
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
            'purchaseId' => $this->purchaseId(),
        ];
        return view('livewire.purchase', $data);
    }
}
