@extends('layouts.master')
@section('title') {{$title}} @endsection
@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
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
        @slot('li_1')  {{$subTitle}} @endslot
        @slot('title') {{$title}} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Project</h4>
                    <form>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Name" type="text" name="shop_name"
                                               placeholder="Enter Shop Name"></x-forms.input>
                            </div>
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Email" type="email" name="shop_email" :required=false
                                               placeholder="Enter Shop Email"></x-forms.input>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Phone 1" type="text" name="shop_phone_one" :required=false
                                               placeholder="Enter Shop Phone 1"></x-forms.input>
                            </div>
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Phone 2" type="text" name="shop_phone_two" :required=false
                                               placeholder="Enter Shop Phone 2"></x-forms.input>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Mobile 1" type="text" name="shop_mobile_one" :required=false
                                               placeholder="Enter Shop Mobile 1"></x-forms.input>
                            </div>
                            <div class="col-lg-6">
                                <x-forms.input label="Shop Mobile 2" type="text" name="shop_mobile_two" :required=false
                                               placeholder="Enter Shop Mobile 2"></x-forms.input>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.textarea label="Shop Address" type="text" name="shop_address" :required=false
                                                  placeholder="Customer Address"></x-forms.textarea>
                            </div>
                            <div class="col-md-6">
                                <level class="text-center">Shop LOGO</level>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="shop_logo" id="imageUpload" accept=".png, .jpg, .jpeg"/>
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
                    </form>
                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2">Attached Files</label>
                        <div class="col-lg-10">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
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
@endsection
