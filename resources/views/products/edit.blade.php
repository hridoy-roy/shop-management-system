@extends('layouts.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            {{$subTitle}}
        @endslot
        @slot('title')
            {{$title}}
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{$title}} Edit</h4>

                    <form class="custom-validation" action="{{route('products.update',$product->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <x-forms.input label="Name" type="text" name="name"
                                       placeholder="Enter Name" :value="$product->name"></x-forms.input>

                        <x-forms.select label="Categories Name" name="product_category_id"
                                        :options="$categories" :value="$product->product_category_id"></x-forms.select>

                        <x-forms.select label="Unit Name" name="unit_name"
                                        :options="$utility::$units" :value="$product->unit_name"></x-forms.select>

                        <x-forms.input label="Price" type="number" name="price"
                                       placeholder="Enter Product Price" :value="$product->price"></x-forms.input>
                        <div class="row">
                            <div class="col-md-12">
                                <x-forms.textarea label="Description" type="text" name="description" :required=false
                                                  placeholder="Enter Your Category Description" :value="$product->description"></x-forms.textarea>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="Status" name="status"
                                                :options="$utility::$status" :value="$product->status"></x-forms.select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="card-title">{{$title}} List</h4>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0 text-center">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <th scope="row">{{++$loop->index}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->unit_name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="btn btn-success btn-sm">Active</span>
                                            @elseif($product->status == 0)
                                                <span class="btn btn-danger btn-sm">In Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('products.edit',$product->id)}}"
                                               class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                            <form action="{{route('products.destroy',$product->id)}}" method="POST"
                                                  class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger"><strong>No Data</strong></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>

@endsection
