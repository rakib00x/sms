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
                            <h2 class="content-header-title float-start mb-0">Settings</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Default Settings</li>
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

                                    <div class="col-12">
                                        <div class="mb-1">

                                            <div class="alert alert-success" role="alert" id="notification" style="display: none;">
                                                <div class="alert-body"><strong>Success:</strong> the settings updated successfully !!</div>
                                            </div>

                                        </div>
                                    </div>

                                    {!! Form::open(['id' => 'update-default-settings', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Default Sending Limit</label>
                                            <input type="text" value="{{ $settings->default_sending_limit }}" name="default_sending_limit" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Default Days</label>
                                            <input type="text" value="{{ $settings->default_days }}" name="default_days" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Expired Sending Limit</label>
                                            <input type="text" value="{{ $settings->expired_sending_limit }}" name="expired_sending_limit" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="UPDATE" class="btn btn-success" />
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

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

    <script>
        $(document).ready(function(){
            $("#update-default-settings").on('submit',function(e){
                e.preventDefault();

                let default_sending_limit   = $('[name="default_sending_limit"]').val();
                let default_days            = $('[name="default_days"]').val();
                let expired_sending_limit   = $('[name="expired_sending_limit"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/update-default-settings') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{default_sending_limit:default_sending_limit,default_days:default_days,expired_sending_limit:expired_sending_limit},
                    success:function(data)
                    {
                        if(data == "true"){
                            toastr.success('Default Setting Update Successfully !!', 'Success');
                        }
                    }
                });

            });
        })
    </script>

@endsection
