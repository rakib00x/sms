@extends('admin.master-admin')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Validity</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">User Validity</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-12 col-md-12 col-12">

                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <table class="table table-striped" id="table-2">
                                        <tbody>
                                        <th>Validity in days</th>
                                        <th>Sending limit per day</th>
                                        <th>Expire at</th>
                                        <th>Days remaining</th>
                                        </tbody>
                                        <tbody>
                                        <td class="one">{{ $default_days }} ({{ $updated_at }})</td>
                                        <td class="two">{{ $default_sending_limit }}</td>
                                        <td class="three">{{ $validity_expire_at }}</td>
                                        <td class="four">{{ $remaining }}</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/app-assets/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/app-assets/css/plugins/forms/form-quill-editor.css') }}">
    <link href="https://unpkg.com/quill-better-table@1.2.8/dist/quill-better-table.css" rel="stylesheet">
    <!-- END: Page CSS-->
@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ URL::to('backend/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ URL::to('backend/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ URL::to('backend/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ URL::to('backend/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
    <!-- END: Page JS-->
@endsection
