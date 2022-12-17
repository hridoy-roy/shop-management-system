<div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Purchase Return Number <span class="text-warning">#{{$purchaseReturnId}}</span></h4>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Final Sum <span class="text-success">: {{$finalTotal}}</span></h4>
                    <h4 class="card-title">Total Qty <span class="text-success">: {{$totalQty}}</span></h4>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-4">
                        <div class="col-md-6">
                            <h3 class="card-title mb-4">{{$title}} Create</h3>
                        </div>
                        <div class="col-md-6">
                             <span wire:loading.remove data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                   data-bs-original-title="Add New" class="btn btn-success mt-3 mt-lg-0 float-end"
                                   wire:click="addRow()">
                                    <i class="fas fa-plus-circle"></i>
                                    Row
                                </span>
                            <div wire:loading class="spinner-border spinner-border-sm text-dark">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>


                        <form wire:submit.prevent="submit">
                            @foreach($repeater as $key => $row)
                                <div class="row m-0">
                                    <div class="col-lg-3">
                                        <x-forms.select label="Product Name" name="product_id.{{$key}}"
                                                        :options="$products"></x-forms.select>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label>Unit</label>
                                            <p class="form-control">{{$productunit[$key] ?? "N/A"}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="mb-3">
                                            <label>Stock</label>
                                            <p class="form-control">{{$availableStock[$key] ?? 0}}</p>
                                        </div>
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
                                        <div class="row">
                                            <div class="col">
                                                <p class="form-control">{{$total[$key]}}</p>
                                            </div>
                                            <div class="col-2">
                                             <span class="btn btn-danger mt-3 mt-lg-0" data-bs-toggle="tooltip"
                                                   data-bs-placement="top" title=""
                                                   data-bs-original-title="Delete" wire:click="removeRow({{$key}})">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            <div class="row mx-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-lg btn-success mt-3 mt-lg-0">
                                        <i class="fas fa-save"></i>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
