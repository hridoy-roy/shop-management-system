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
                        {{--                        @dd($utility::$status)--}}
                        <x-forms.input label="Name" type="text" name="name"
                                       placeholder="Enter Your First Name"></x-forms.input>
                        <div class="row">
                            <div class="col-md-12">
                                <x-forms.textarea label="Description" type="text" name="description"
                                                  placeholder="Enter Your Category Description"></x-forms.textarea>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="Status" name="status"
                                                :options="$utility::$status"></x-forms.select>

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
                            <table class="table align-middle mb-0 text-center">

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
                                        <th scope="row">{{++$loop->index}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->description}}</td>
                                        <td>
                                            @if($category->status == 1)
                                                <span class="btn btn-success btn-sm">Active</span>
                                            @elseif($category->status == 0)
                                                <span class="btn btn-danger btn-sm">In Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('categories.edit',$category->id)}}"
                                               class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                            <form action="{{route('categories.destroy',$category->id)}}" method="POST"
                                                  class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
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
