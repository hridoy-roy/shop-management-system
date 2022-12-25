<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Product;
use App\Treat\Repeater;
use App\Treat\SaleId;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

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
    public $customer_id;
    public $discount;
    public $type;
    public $saleId;
    public $sale;
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
            $this->finalTotal = array_sum($this->total) - $this->discount;
            $this->totalQty = array_sum($this->quantity);
        }
        if ($name == 'discount') {
            $this->finalTotal = (!is_null(array_sum($this->total)) ?? 0) - (is_numeric($this->discount) ? $this->discount : 0);
            if (isset($this->quantity)) {
                $this->totalQty = array_sum($this->quantity) ?? 0;
            }
        }
    }

    public function submit()
    {
        try {
            DB::beginTransaction();
            $sale = \App\Models\Sale::create([
                'sale_num' => $this->SaleId(),
                'customer_id' => $this->customer_id,
                'amount' => $this->finalTotal,
                'discount' => $this->discount,
                'type' => $this->type,
                'created_by' => \Auth::user()->name,
            ]);
            $sale->saleDetails()->createMany($this->saleDetails($this->validate()));
            DB::commit();
            $this->reset();
            $this->saleId = $this->saleId();
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

    public function update()
    {
        try {
            DB::beginTransaction();
            $this->sale->update([
                'sale_num' => $this->saleId,
                'customer_id' => $this->customer_id,
                'amount' => $this->finalTotal,
                'discount' => $this->discount,
                'type' => $this->type,
                'updated_by' => \Auth::user()->name,
            ]);
            $this->sale->saleDetails()->delete();
            $this->sale->saleDetails()->createMany($this->saleDetails($this->validate()));
            DB::commit();
            $this->reset();
            $this->redirectRoute('sales.index');
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
            toastr()->error('Data Not Updated successfully!');
            $this->reset();
            return redirect()->back();
        }
        toastr()->success('Data has been Updated successfully!');
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

    public function mount()
    {
        if ($this->sale) {
            $this->customer_id = $this->sale->customer_id;
            $this->saleId = $this->sale->sale_num;
            $this->finalTotal = $this->sale->amount;
            $this->discount = $this->sale->discount;
            $this->type = 'Cash';
            foreach ($this->sale->saleDetails as $key => $saleDetail) {
                $this->product_id[$key] = $saleDetail->product_id;
                $this->productunit[$key] = $saleDetail->product->unit_name;
                $this->price[$key] = $saleDetail->rate;
                $this->totalQty += $saleDetail->qty;
                $this->quantity[$key] = $saleDetail->qty;
                $this->total[$key] = $saleDetail->amount;
                $this->repeater[$key] = +1;
            }
        } else {
            $this->saleId = $this->saleId();
        }
    }

    public function render()
    {
        $data = [
            'subTitle' => 'Sale Info',
            'title' => 'Purchase',
            'products' => Product::where('status', 1)->get(),
            'customers' => Customer::where('status', 1)->get(),
        ];
        return view('livewire.sale', $data);
    }
}
