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
                                    <li class="breadcrumb-item">Extend Validity</li>
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
                                                <div class="alert-body"><strong>Success:</strong> the validity has been updated successfully !!</div>
                                            </div>

                                        </div>
                                    </div>

                                    {!! Form::open(['id' => 'update-extend-validity', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Template Name</label>
                                            <select class="form-select select2" name="customer_id">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->mobile }} - {{ $customer->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Validity in days</label>
                                            <input type="text" name="default_days" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Sending limit per day</label>
                                            <input type="text" name="default_sending_limit" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="EXTEND VALIDITY" class="btn btn-success" />
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

                                </div>
                            </div>

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
                                            <td class="one"></td>
                                            <td class="two"></td>
                                            <td class="three"></td>
                                            <td class="four"></td>
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

    <script>
        $(document).ready(function(){

            $('[name="customer_id"]').change(function(e){
                e.preventDefault();

                var customer_id = $('[name="customer_id"] :selected').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/get-validity-info') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{customer_id:customer_id},
                    success:function(data)
                    {
                        let arr = data.split("#");
                        let default_sending_limit = arr[0];
                        let default_days = arr[1];
                        let validity_expire_at = arr[2];
                        let remaining = arr[3];
                        let updated_at = arr[4];

                        $('.one').text(default_days+" ("+updated_at+" )");
                        $('.two').text(default_sending_limit);
                        $('.three').text(validity_expire_at);
                        $('.four').text(remaining);

                    }
                });
            })

            $("#update-extend-validity").on('submit',function(e){
                e.preventDefault();

                let customer_id  = $('[name="customer_id"]').val();
                let default_sending_limit   = $('[name="default_sending_limit"]').val();
                let default_days   = $('[name="default_days"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/update-extend-validity') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{customer_id:customer_id,default_sending_limit:default_sending_limit,default_days:default_days},
                    success:function(data)
                    {
                        if(data == "true"){
                             toastr.success('Extend Validity Update Successfully !!', 'Success');
                        }
                    }
                });

            });



        })
    </script>

@endsection
