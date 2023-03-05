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
    <style>
        #cover-spin {
            position:fixed;
            width:100%;
            left:0;right:0;top:0;bottom:0;
            background-color: rgba(255,255,255,0.7);
            z-index:9999;
            display:none;
        }

        @-webkit-keyframes spin {
            from {-webkit-transform:rotate(0deg);}
            to {-webkit-transform:rotate(360deg);}
        }

        @keyframes spin {
            from {transform:rotate(0deg);}
            to {transform:rotate(360deg);}
        }

        #cover-spin::after {
            content:'';
            display:block;
            position:absolute;
            left:48%;top:40%;
            width:40px;height:40px;
            border-style:solid;
            border-color:black;
            border-top-color:transparent;
            border-width: 4px;
            border-radius:50%;
            -webkit-animation: spin .8s linear infinite;
            animation: spin .8s linear infinite;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<div id="cover-spin"></div>    
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row mx-2">
                {!! Form::open(['url' => 'post-user-registration-data', 'method' => 'post']) !!}

                <h2 class="mt-2">Registration</h2>

                <div class="mb-1">

                    <?php if(Session::get('success') != null) { ?>
                    <div class="alert alert-success" role="alert">
                        <div class="alert-body"><strong>Suucess !!</strong> <?php echo Session::get('success') ; ?></div>
                        <?php Session::put('success',null) ;  ?>
                    </div>
                    <?php } ?>

                    <?php if(Session::get('failed') != null) { ?>
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body"><strong>Failed !!</strong> <?php echo Session::get('failed') ; ?></div>
                        <?php Session::put('failed',null) ;  ?>
                    </div>
                    <?php } ?>
                </div>

                <div class="mb-1">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" type="text" name="name"/>
                </div>

                <div class="mb-1">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" name="mobile"/>
                </div>

                <div class="mb-1">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" type="text" name="email"/>
                </div>

                <div class="mb-1">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="text" onkeypress="return isNumber(event)" name="password"/>
                </div>

                <div class="mb-1">
                    <label>Choose Country</label>
                    <select class="form-select select2" name="country">
                        <option value="">Select Country</option>
                        <?php foreach($countries as $country){ ?>
                        <option value="<?php echo $country->id; ?>"><?php echo $country->countryname ; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-1">
                    <label>Choose Division</label>
                    <select class="form-select select2" name="division">
                        <option value="">Select Divison</option>
                        <?php foreach($divisions as $division){ ?>
                        <option value="<?php echo $division->id; ?>"><?php echo $division->div_name ; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-1">
                    <label>Choose District</label>
                    <select class="form-select select2" name="district">

                    </select>
                </div>

                <div class="mb-1">
                    <label>Choose Upzela</label>
                    <select class="form-select select2" name="upzila">

                    </select>
                </div>

                <div class="mb-1">
                    <label>Choose Occupation</label>
                    <select class="form-select select2" name="occupation">
                        <option value="">Select Occupation</option>
                        <?php foreach($occupations as $occupation){ ?>
                        <option value="<?php echo $occupation->id; ?>"><?php echo $occupation->occupation ; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-1">
                    <div class="form-check">
                        <input class="form-check-input" name="agree" type="checkbox" tabindex="13" />
                        <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary w-100" value="Sign Up" />

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
    $('[name="country"]').change(function(e){
        e.preventDefault();

        var country_id = $('[name="country"] :selected').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/get-division-by-country') }}",
            'type':'post',
            'dataType':'text',
            data:{country_id:country_id},
            beforeSend: function() {
                $('#cover-spin').show(0);
            },
            success:function(data)
            {
                $('[name="division"]').empty();
                $('[name="division"]').html(data);
            },
            error: function(data) {
                console.log(data.status);
            },
            complete: function() {
                $('#cover-spin').hide(0);
            }
        });
    })

    $('[name="division"]').change(function(e){
        e.preventDefault();

        var division_id = $('[name="division"] :selected').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/get-district-by-division') }}",
            'type':'post',
            'dataType':'text',
            data:{division_id:division_id},
            beforeSend: function() {
                $('#cover-spin').show(0);
            },
            success:function(data)
            {
                console.log(data);
                $('[name="district"]').empty();
                $('[name="district"]').html(data);
            },
            error: function(data) {
                console.log(data.status);
            },
            complete: function() {
                $('#cover-spin').hide(0);
            }
        });
    })

    $('[name="district"]').change(function(e){
        e.preventDefault();

        var district_id = $('[name="district"] :selected').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/get-upzila-by-district') }}",
            'type':'post',
            'dataType':'text',
            data:{district_id:district_id},
            beforeSend: function() {
                $('#cover-spin').show(0);
            },
            success:function(data)
            {
                console.log(data);
                $('[name="upzila"]').empty();
                $('[name="upzila"]').html(data);
            },
            error: function(data) {
                console.log(data.status);
            },
            complete: function() {
                $('#cover-spin').hide(0);
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
