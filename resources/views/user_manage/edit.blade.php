@extends('layouts.master')
@section('title')
    {{$title}}
@endsection

@section('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                    <form action="{{route('users.update',$user->id)}}" method="Post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.input label="Full Name" type="text" name="name"
                                               placeholder="Full Name" :value="$user->name"></x-forms.input>
                            </div>
                            <div class="col-md-6">
                                <x-forms.input-date label="Joining Date" name="joining_date" :required="false"
                                                    :value="$user->joining_date"></x-forms.input-date>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.input label="Phone Number" type=number name="phone"
                                               placeholder="Phone Number 11 Digits" :required=false :value="$user->phone" ></x-forms.input>
                            </div>
                            <div class="col-md-6">
                                <x-forms.input label="Email Address" type=email name="email"
                                               placeholder="Email Address"  :value="$user->email" ></x-forms.input>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.textarea label="Staff Address" type="text" name="address" :required=false
                                                  placeholder="Customer Address"  :value="$user->address" ></x-forms.textarea>
                            </div>
                            <div class="col-md-6">
                                <level class="text-center">Staff Image</level>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        @if($user->avatar)
                                            <div id="imagePreview"
                                                 style="background-image: url({{asset($user->avatar)}});">
                                            </div>
                                        @else
                                            <div id="imagePreview"
                                                 style="background-image: url(http://i.pravatar.cc/500);">
                                            </div>
                                        @endif

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
