<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Treat\Repeater;
use Livewire\Component;

class Purchase extends Component
{
    use Repeater;

    public $product_id;
    public $price;
    public $singlePrice;
    public $quantity;
    public array $productunit = [null];
    public array $productCategory = [null];
    public array $total = [0];
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
            $this->singlePrice = $value ;
        }
        if (str_starts_with($name, 'quantity.')) {
            $nameKey = explode(".", $name);
            $this->total[$nameKey[1]] = $this->singlePrice * $value ;
        }
    }


    public function submit()
    {
        dd($this->validate());
        $validatedData = $this->validate();

        Contact::create($validatedData);
    }

    public function render()
    {
        $data = [
            'products' => Product::where('status', 1)->get(),
        ];
        return view('livewire.purchase', $data);
    }
}
