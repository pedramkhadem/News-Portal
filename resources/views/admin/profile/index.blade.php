@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Profile')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{$user->name}}</h2>
            <p class="section-lead">
                {{__('Change information about yourself on this page')}}.
            </p>

            <div class="row mt-sm-4">

                <div class="col-12 col-md-6 ">
                    <div class="card">

                        <form method="post" action="{{ route('admin.profile.update',$user->id) }}"
                              class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('Edit Profile')}}</h4>

                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    <label class="col-form-label text-md-left">{{__('Thumbnail')}}</label>
                                    <div id="image-preview" class="image-preview mb-4">
                                        <label for="image-upload" id="image-label">{{__('Choose File')}}</label>
                                        <input type="file" name="image" id="image-upload"/>
                                        <input type="hidden" name="old_image" value="{{ $user->image }}"/>
                                    </div>
                                    @error('image')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                    <label>{{__('First Name')}}</label>
                                    <input type="text" class="form-control" value="{{$user->name}}" required="" name="name">
                                    <div class="invalid-feedback" >
                                        {{__('Please fill in the First Name')}}
                                    </div>
                                    @error('name')
                                        <p class="invalid-feedback"> {{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Email')}}</label>
                                    <input type="text" class="form-control" value="{{$user->email}}" required="" name="email">
                                    <div class="invalid-feedback" >
                                        {{__('Please fill in the email')}}
                                    </div>
                                    @error('email')
                                    <p class="invalid-feedback"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--password-->
                <div class="col-12 col-md-6 ">
                    <div class="card">
                        <form method="post" action="{{ route('admin.profile-password.update',$user->id) }}" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('Update Password')}}</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group col-12">
                                    <label>{{__('Old Password')}}</label>
                                    <input type="password" class="form-control" value="" required="" name="current_password">
                                    <div class="invalid-feedback">
                                        {{__('Please fill in the old password')}}
                                    </div>
                                    @error('current_password')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('New Password')}}</label>
                                    <input type="password" class="form-control" value="" required="" name="password">
                                    <div class="invalid-feedback">
                                        {{__('Please fill in new password')}}
                                    </div>
                                    @error('password')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror

                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Confirmed Password')}}</label>
                                    <input type="password" class="form-control" value="" required="" name="password_confirmation">
                                    <div class="invalid-feedback">
                                        {{__('Please fill in confirmed password')}}
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
                $('.image-preview').css({
                    "background-image": "url({{ asset($user->image) }})",
                    "background-position": "center center",
                    "background-size":"cover",
                });
        })
    </script>
@endpush
