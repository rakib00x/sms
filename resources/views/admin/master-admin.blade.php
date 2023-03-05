<?php
$settings = DB::table('settings')->where('id',1)->first();
$basicinfo = DB::table('admin')->where('id',Session::get('user_id'))->first();
?>
<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="the apps for working with SMS">
    <meta name="keywords" content="availtrade sms service provider in Bangladesh">
    <meta name="author" content="MD. AMANAT ULLAH">
    <title>Availtrade- Business Solution</title>
    <link rel="apple-touch-icon" href="{{ URL::to('public/backend/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('public/backend/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/extensions/toastr.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/forms/pickers/form-pickadate.min.css') }}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/assets/css/style.css') }}">
    <!-- BEGIN: Custom CSS for SMS Counter -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/counter/css/style.css') }}">
    
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

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
	<link rel="stylesheet" href="{{ URL::to('public/backend/assets/css/toast.css') }}">
    <!-- END: Custom CSS-->
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
@php
$info = DB::table('admin')->where('id',Session::get('user_id'))->first();
@endphp

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
<!-- BEGIN: Header-->
<div id="cover-spin"></div>
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <p>Hi,  {{ $basicinfo->name }}</p>
        </div>
        &nbsp;&nbsp;
        @php
        $con = DB::table('contacts')->where('added_by',Session::get('user_id'))->count();
        @endphp
        <h3 class="pl-2 text-center">Count Contact: <?php echo $con;?></h3>

        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Session::get('user_name') }}</span>
                        <span class="user-status">Admin</span></div>
                    <span class="avatar">
                    <img class="round" src="{{ URL::to('frontend/admin') }}/{{ $info->photo }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ URL::to('admin-profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ URL::to('change-password') }}"><i class="me-50" data-feather="user"></i> Password</a>
                    <a style="display: <?php function isMobileLogout() { return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); } if(isMobileLogout()){ echo 'none;'; }else{ echo ''; } ?>" class="dropdown-item" href="{{ URL::to('signout') }}"><i class="me-50" data-feather="power"></i> Sign Out</a>

                </div>
            </li>
        </ul>
    </div>
</nav>

<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="{{ URL::to('public/backend/app-assets/images/icons/xls.png') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="{{ URL::to('public/backend/app-assets/images/icons/jpg.png') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="{{ URL::to('public/backend/app-assets/images/icons/pdf.png') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="{{ URL::to('public/backend/app-assets/images/icons/doc.png') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="{{ URL::to('public/backend/app-assets/images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="{{ URL::to('public/backend/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="{{ URL::to('public/backend/app-assets/images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="{{ URL::to('public/backend/app-assets/images/portrait/small/avatar-s-6.jpg') }}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ URL::to('admin-dashboard') }}">
                    <span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                    </span>
                    <h2 class="brand-text">{{ $settings->company }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ URL::to('admin-dashboard') }}/{{ Session::get('user_id') }}"><i data-feather="coffee"></i><span class="menu-title text-truncate" data-i18n="Typography">Cabinet</span></a></li>

            <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i data-feather="more-horizontal"></i></li>
              <li class=" nav-item"><a class="d-flex align-items-center" href="{{ URL::to('manage-group') }}"><i data-feather="coffee"></i><span class="menu-title text-truncate" data-i18n="Typography">Group</span></a></li>
            {{--<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">Group</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ URL::to('add-group') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Group</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('manage-group') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Manage Group</span></a>
                    </li>
                </ul>
            </li>--}}
             <li class=" nav-item"><a class="d-flex align-items-center" href="{{ URL::to('manage-template') }}"><i data-feather="coffee"></i><span class="menu-title text-truncate" data-i18n="Typography">Templates</span></a></li>

           {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">Templates</span></a>
                <ul class="menu-content">
                   <li><a class="d-flex align-items-center" href="{{ URL::to('add-template') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Template</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('manage-template') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Manage Template</span></a>
                    </li>
                </ul>
            </li>--}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">Contact</span></a>
                <ul class="menu-content">
                    {{--<li><a class="d-flex align-items-center" href="{{ URL::to('add-contact') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Contact (form)</span></a>--}}
                    <li><a class="d-flex align-items-center" href="{{ URL::to('file-upload') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Contact (txt/csv)</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('manage-contact') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Manage Contact</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">SMS</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ URL::to('send-single-sms') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Send Single SMS</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('send-group-sms') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Send Group SMS</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('set-schedule') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Set Schedule</span></a>
                    </li>
                    <li style="display: <?php if(Session::get('type') != 1){ echo 'none;'; } ?>">
                        <a class="d-flex align-items-center" href="{{ URL::to('send-geo-sms') }}">
                            <i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Sent GEO Message</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">Report</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ URL::to('group-wise-report') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Group Wise Report</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('single-wise-report') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Single Wise Report</span></a>
                </ul>
            </li>

            <li style="display: <?php if(Session::get('type') != 1){ echo 'none;'; } ?>" class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="align-left"></i><span class="menu-title text-truncate" data-i18n="Vertical">Settings</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ URL::to('default-settings') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Default Settings</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('extend-validity') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Extend Validity</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('add-division') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Division</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('add-district') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add District</span></a>
                    <li><a class="d-flex align-items-center" href="{{ URL::to('add-upzela') }}"><i data-feather="corner-down-right"></i><span class="menu-item text-truncate" data-i18n="Vertical">Add Upzela</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ URL::to('user-validity-info') }}"><i data-feather="coffee"></i><span class="menu-title text-truncate" data-i18n="Typography">Validity</span></a></li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://www.baflourmill.com" target="_blank">{{ $settings->company }}</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
        <span class="float-md-end d-none d-md-block">Developed by - <a href="https://www.asianitinc.com">asianitinc.com</a><i data-feather="heart"></i></span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{ URL::to('public/backend/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ URL::to('public/backend/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ URL::to('public/backend/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/js/core/app.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/form-select2.js') }}"></script>
<!-- END: Theme JS-->

<script src="{{ URL::to('public/backend/app-assets/js/custom/jquery.form.js') }}"></script>

<!-- BEGIN: Page Vendor JS-->
<script src="{{ URL::to('public/backend/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- END: Theme JS-->
<script src="{{ URL::to('public/backend/app-assets/js/custom/jquery.form.js') }}"></script>
<script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/pickers/form-pickers.min.js') }}"></script>

<!-- SMS Counter -->
<script type="text/javascript" src="{{ URL::to('public/counter/js/sms_length_count.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/counter/js/sms_length_counter.js') }}"></script>

@yield('js')

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

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

</body>
<!-- END: Body-->

</html>
