<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; news-portal</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/asstes/node_modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('admin/assets/img/stisla-fill.svg') }}" alt="logo" width="100"
                             class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>{{__('Reset Password')}}</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.reset-password.send') }}"
                                  class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{__('Email')}}</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                           required autofocus value="{{ @request()->email }}">
                                    <input id="token" type="hidden" class="form-control" name="token" tabindex="1"
                                           required autofocus value="{{ $token }}">
                                    @error('email')
                                    <code>{{$message}}</code>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('Please fill in your email')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{__('Password')}}</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           tabindex="1"
                                           required autofocus>
                                    @error('password')
                                    <code>{{$message}}</code>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('Please fill in your passwrod')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{__('Confirmation Password')}}</label>
                                    <input id="password" type="password" class="form-control"
                                           name="password_confirmation" tabindex="1"
                                           required autofocus>

                                    <div class="invalid-feedback">
                                        {{__('Please fill in your Confirmation Password')}}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="simple-footer">
                        {{__('Copyright')}} &copy; {{__('Pedram Khademan 2023')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom.js"') }}></script>

  <!-- Page Specific JS File -->
</body>
</html>
