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
    <livewire:purchase></livewire:purchase>


        {{--    <div class="col-xl-12">--}}
        {{--        <div class="card">--}}
        {{--            <div class="card-body">--}}
        {{--                <div class="table-responsive">--}}
        {{--                    <h4 class="card-title">Categories List</h4>--}}

        {{--                    <div class="table-responsive">--}}
        {{--                        <table class="table align-middle mb-0 text-center">--}}

        {{--                            <thead>--}}
        {{--                            <tr>--}}
        {{--                                <th>#</th>--}}
        {{--                                <th>Name</th>--}}
        {{--                                <th>Description</th>--}}
        {{--                                <th>Status</th>--}}
        {{--                                <th>Action</th>--}}
        {{--                            </tr>--}}
        {{--                            </thead>--}}
        {{--                            <tbody>--}}
        {{--                            @forelse($sales as $category)--}}
        {{--                            <tr>--}}
        {{--                                <th scope="row">{{++$loop->index}}</th>--}}
        {{--                                <td>{{$category->name}}</td>--}}
        {{--                                <td>{{$category->description}}</td>--}}
        {{--                                <td>--}}
        {{--                                    @if($category->status == 1)--}}
        {{--                                    <span class="badge bg-success font-size-10">Active</span>--}}
        {{--                                    @elseif($category->status == 0)--}}
        {{--                                    <span class="badge bg-danger font-size-10">In Active</span>--}}
        {{--                                    @endif--}}
        {{--                                </td>--}}
        {{--                                <td>--}}
        {{--                                    <a href="{{route('categories.edit',$category->id)}}"--}}
        {{--                                       class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>--}}
        {{--                                    <form action="{{route('categories.destroy',$category->id)}}" method="POST" class="d-inline">--}}
        {{--                                        @method('DELETE')--}}
        {{--                                        @csrf--}}
        {{--                                        <button type="submit" class="btn btn-danger btn-sm">--}}
        {{--                                            <i class="fas fa-trash-alt"></i>--}}
        {{--                                        </button>--}}
        {{--                                    </form>--}}
        {{--                                </td>--}}
        {{--                            </tr>--}}
        {{--                            @empty--}}
        {{--                            <tr>--}}
        {{--                                <td colspan="3" class="text-center text-danger">No Data</td>--}}
        {{--                            </tr>--}}
        {{--                            @endforelse--}}
        {{--                            </tbody>--}}
        {{--                        </table>--}}
        {{--                    </div>--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <!-- end card body -->--}}
        {{--        </div>--}}
        {{--        <!-- end card -->--}}
        {{--    </div>--}}
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ asset('/assets/js/pages/form-validation.init.js') }}"></script>

@endsection
