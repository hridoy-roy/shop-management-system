<div>
    <form wire:submit.prevent="submit">
        @foreach($repeater as $key => $row)
            <div class="row m-0">
                <div class="col-lg-3">
                    <x-forms.select label="Product Name" name="product_id.{{$key}}"
                                    :options="$products"></x-forms.select>
                </div>
                <div class="col-lg-2">
                    <label class="mb-0">Unit : {{$productunit[$key]}}</label><br>
                    <label class="mb-0">Category : {{$productCategory[$key]}}</label><br>
                    <label class="mb-0">Available : 2</label>
                </div>
                <div class="col-lg-2">
                    <x-forms.input label="Price" type="number" name="price.{{$key}}"
                                   placeholder="Price"></x-forms.input>
                </div>

                <div class="col-lg-2">
                    <x-forms.input label="Quantity" type="number" name="quantity.{{$key}}"
                                   placeholder="Quantity"></x-forms.input>
                </div>
                <div class="col-lg-2">
                    <label for="resume">Total</label>
                    <p class="form-control">{{$total[$key]}}</p>
                </div>
                <div class="col-lg-1 align-self-center">
                        <span class="btn btn-danger mt-3 mt-lg-0" wire:click="removeRow({{$key}})"><i class="fas fa-trash-alt"></i></span>
                </div>
            </div>
        @endforeach


    <div>
            <span wire:loading.remove class="btn btn-success mt-3 mt-lg-0" wire:click="addRow()">
                <i class="fas fa-plus-circle"></i>
                Add
            </span>
            <div wire:loading class="spinner-border spinner-border-sm text-dark">
                <span class="sr-only">Loading...</span>
            </div>
        <div class="float-end">
            <button type="submit" class="btn btn-success mt-3 mt-lg-0">
                Submit
            </button>
        </div>
    </div>
    </form>

</div>
