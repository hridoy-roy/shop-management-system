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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Category Create</h4>

                    <form class="custom-validation" action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <x-forms.input label="Name" type="text" name="name"
                                       placeholder="Enter Your First Name"></x-forms.input>

                        <div class="row">
                            <div class="col-md-12">
                                <x-forms.textarea label="Description" type="text" name="description"
                                                  placeholder="Enter Your Category Description"></x-forms.textarea>

                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="Status" name="status"
                                                :options="['1'=>'Active','0'=> 'In Active']"></x-forms.select>

                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h4 class="card-title">Categories List</h4>

                            <div class="table-responsive">
                                <table class="table align-middle mb-0">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $category)
                                    <tr>
                                        <th scope="row"></th>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->description}}</td>
                                        <td>{{$category->Status}}</td>
                                        <td>
                                            <button type="button" class="btn btn-light btn-sm">View</button>
                                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-danger">No Data</td>
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
