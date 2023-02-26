@extends('layouts.master')
@section('title')
    {{$title}}
@endsection

@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
          type="text/css">
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all .2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        data-bs-toggle="modal" data-bs-target=".customer-modal-xl"><i
                                        class="mdi mdi-plus me-1"></i> New Customers
                                </button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap text-center">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Shop Name</th>
                                <th>Phone / Email</th>
                                <th>Address</th>
                                <th>Reference</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customers as $customer)

                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>{{$customer->name}}
                                        @php
                                        $jd = \Illuminate\Support\Carbon::create($customer->joining_date);
                                        @endphp
                                        @if($jd->diffInDays(now('Asia/Dhaka')) < $utility::$newStatusDayValue)
                                        <span class="badge rounded-pill bg-success float-end"  key="t-new">New</span>
                                        @endif
                                    </td>
                                    <td>{{$customer->shop_name ?? 'N/A'}}</td>
                                    <td>
                                        <p class="mb-1">{{$customer->phone ?? 'N/A'}} /</p>
                                        <p class="mb-0">{{$customer->email ?? 'N/A'}}</p>
                                    </td>

                                    <td>{{$customer->address ?? 'N/A'}}</td>
                                    <td>{{$customer->reference->name ?? 'N/A'}}</td>
                                    <td>{{$customer->joining_date}} / {{$jd->diffForHumans(['parts' => 2,'short' => true])}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                               aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{route('customer.edit',$customer->id)}}"
                                                       class="dropdown-item"><i
                                                            class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                        Edit</a></li>
                                                <li><a href="#" class="dropdown-item" onclick="customerDelete({{$customer->id}})" ><i
                                                            class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                        Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <strong>No Data</strong>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination pagination-rounded justify-content-end mb-2">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!--  Extra Large modal example -->
    <div class="modal fade customer-modal-xl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Create New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('customer.store')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.input label="Full Name" type="text" name="name"
                                               placeholder="Full Name"></x-forms.input>
                            </div>
                            <div class="col-md-6">
                                <x-forms.select label="Reference" name="customer_id" :required="false"
                                                :options="$customers"></x-forms.select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.input-date label="Joining Date" name="joining_date" :required="false"
                                                    value="{{now('Asia/Dhaka')}}"></x-forms.input-date>
                            </div>
                            <div class="col-md-6">
                                <x-forms.input label="Shop Name" type="text" name="shop_name" :required="false"
                                               placeholder="Shop Name"></x-forms.input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.input label="Phone Number" type=number name="phone"
                                               placeholder="Phone Number 11 Digits" :required=false></x-forms.input>
                            </div>
                            <div class="col-md-6">
                                <x-forms.input label="Email Address" type=email name="email"
                                               placeholder="Email Address" :required=false></x-forms.input>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.textarea label="Customer Address" type="text" name="address" :required=false
                                                  placeholder="Customer Address"></x-forms.textarea>
                            </div>
                            <div class="col-md-6">
                                <level class="text-center">Customer Image</level>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                             style="background-image: url(http://i.pravatar.cc/500);">
                                        </div>
                                    </div>
                                </div>
                                @error('avatar')
                                <div class="is-invalid">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('script')

    <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
@endsection

@section('script-bottom')
    <script>
        function customerDelete(Id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function (t) {
                t.value ?  $.ajax({
                    url: "{{ url('customer') }}" + "/" + Id,
                    type: "delete",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Customer Info has been deleted.",
                            icon: "success",
                        });
                        setTimeout(location.reload.bind(location), 2000);
                    },
                    error: function (response) {
                        Swal.fire({
                            title: "Fail",
                            text: "Customer Delete Fail",
                            icon: "error"
                        });
                    }
                }): t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Cancelled",
                    text: "Customer Delete Cancelled",
                    icon: "error"
                });
            });
        }
    </script>
@endsection
