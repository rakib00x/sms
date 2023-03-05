<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register Page - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ URL::to('public/backend/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('public/backend/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row mx-2">
                {!! Form::open(['id' => 'signin', 'method' => 'post']) !!}

                <h2 class="mt-2">Login</h2>

                <div class="mb-1">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" name="mobile"/>
                </div>

                <div class="mb-1">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="text" name="password"/>
                </div>

                <input type="submit" class="btn btn-primary w-100" value="SIGN IN" />

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{ URL::to('public/backend/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ URL::to('public/backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ URL::to('public/backend/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ URL::to('public/backend/app-assets/js/scripts/pages/page-auth-register.js') }}"></script>
<!-- END: Page JS-->

<script src="{{ URL::to('public/backend/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/form-select2.js') }}"></script>

<script>
    $('#signin').on('submit',function(e){
        e.preventDefault();

        var mobile = $('[name="mobile"]').val();
        var password = $('[name="password"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/post-user-login-data') }}",
            'type':'post',
            'dataType':'text',
            data:{mobile:mobile,password:password},
            success:function(data)
            {
                if(data == 'm'){
                    alert('You missed mobile');
                }else if(data == 'p'){
                    alert('You missed password');
                }else if(data == 'no'){
                    alert('User not exist');
                }else{
                    //location.href = '{{ URL::to('admin-dashboard') }}'+'/'+data;
                }

            }
        });
    })
</script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

</body>
<!-- END: Body-->

</html>
