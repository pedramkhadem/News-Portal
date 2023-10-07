<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="og:title" content="@yield('meta_og_title')">
    <meta name="og:description" content="@yield('meta_og_description')">
    <meta name="og:image" content="@yield('meta_og_image')">
    <meta name="twitter:title" content="@yield('meta_tw_title')">
    <meta name="twitter:description" content="@yield('meta_tw_description')">
    <meta name="twitter:image" content="@yield('meta_tw_image')">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header news -->
    @include('frontend.layouts.header')
    <!-- End Header news -->

    @yield('content')

 <!-- Popular news category -->
    @include('frontend.layouts.footer')
<!-- End Popular news category -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $('#site-language').on('change' , function(){
                let languageCode = $(this).val();
                $.ajax({
                    method : 'GET',
                    url : "{{ route('language') }}",
                    data : {language_code : languageCode},
                    success: function(data){
                        if(data.status === 'success'){
                            window.location.href = "{{ url('/') }}";
                        }
                    },
                    error : function(data){
                        console.error(data);

                    }
                });
            })
        })
    </script>

    @stack('content')
</body>

</html>
