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
                            <h2 class="content-header-title float-start mb-0">Sessings</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Add Upzela</li>
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

                                            <div class="alert alert-warning" role="alert" id="count" style="display: none;">
                                                <div class="alert-body"><strong>Warning:</strong> you have taken more contact !!</div>
                                            </div>

                                            <div class="alert alert-success" role="alert" id="notification" style="display: none;">
                                                <div class="alert-body"><strong>Success:</strong> the message sent successfully !!</div>
                                            </div>

                                        </div>
                                    </div>

                                    {!! Form::open(['id' => 'store-upzela', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Template Name</label>
                                            <select class="form-select select2" name="country">
                                                <option value="">Select Country</option>
                                                <?php foreach($countries as $country){ ?>
                                                <option value="<?php echo $country->id; ?>"><?php echo $country->countryname ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <label>Choose Division</label>
                                        <select class="form-select select2" name="division">

                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label>Choose District</label>
                                        <select class="form-select select2" name="district">

                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label>Upzela</label>
                                        <input class="form-control" type="text" name="upzela"/>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="SUBMIT" class="btn btn-success" />
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
                success:function(data)
                {
                    console.log(data);
                    $('[name="division"]').empty();
                    $('[name="division"]').html(data);
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
                success:function(data)
                {
                    console.log(data);
                    $('[name="district"]').empty();
                    $('[name="district"]').html(data);
                }
            });
        })

        $("#store-upzela").on('submit',function(e){
            e.preventDefault();

            var district = $('[name="district"] :selected').val();
            var upzela = $('[name="upzela"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/store-upzela') }}",
                'type':'post',
                'dataType':'text',
                data:{district:district,upzela:upzela},
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success:function(data)
                {
                    if(data == 'true'){
                        toastr.success('Upzela added successfully', 'Success');
                        // alert('Upzela added successfully');
                    }
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
@endsection
