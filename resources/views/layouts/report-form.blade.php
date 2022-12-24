<form class="row row-cols-lg-auto g-3 align-items-center justify-content-center mb-3" action="{{route($path)}}" method="post">
    @csrf
    <div class="col-12">
        <x-forms.input-date label="From Date" name="from_date" :required="false" value="{{$from_date}}"></x-forms.input-date>
    </div>
    <div class="col-12">
        <x-forms.input-date label="To Date" name="to_date" :required="false" value="{{$to_date}}"></x-forms.input-date>
    </div>

    <div class="col-12">
        <x-forms.select label="Product Name" name="product_id"
                        :options="$products" :required="false" value={{$product_id}} ></x-forms.select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary w-md mt-2">Submit</button>
    </div>
</form>

