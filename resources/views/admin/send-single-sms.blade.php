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
                            <h2 class="content-header-title float-start mb-0">SMS</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Send Single SMS</li>
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

                                    {!! Form::open(['id' => 'send-single-sms-by-phone', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Enter mobile here or select from below list</label>
                                            <input type="text" placeholder="Enter Mobile Number Here" name="mobile" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Select only one mobile</label>
                                            <select class="form-select select2" name="contact">
                                                <option value="">Select a mobile number</option>
                                                @foreach($contacts as $contact)
                                                    <option value="{{ $contact->mobile }}">{{ $contact->name }} => {{ $contact->mobile }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="alert alert-primary" role="alert">
                                                <div class="alert-body">Write Message</div>
                                            </div>
                                            <textarea id="SmsPackContent" name="message" class="form-control" rows="6" placeholder="Write your message here"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="SEND MESSAGE" class="btn btn-danger" />
                                        </div>
                                    </div>

                                    <div class="row section-space--pb_60 border-bottom-dash mt-2">
                                        <div class="col-md-12">
                                            <table align="center" style="width:100%">
                                                <tr>
                                                    <td width="50%" style="vertical-align: middle;">
                                                        <b><span id="sms_total_chars">0</span> characters=<span id="sms_count">0</span> SMS</b>
                                                    </td>
                                                    <td style="text-align:right;vertical-align: middle;" width="50%">
                                                        <span id="sms_charset">GSM 03.38</span> charset,<span id="sms_chars_left">160</span> left
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="4" cellspacing="4" align="center" width="100%" style="border:1px solid #cdcdcd;padding:10px">
                                                <tr>
                                                    <td><span style="padding-left:15px"><b>Detailed view of SMS buildup</b></span></td>
                                                </tr>
                                                <tr>
                                                    <td><div id="sms_details"></div></td>
                                                </tr>
                                            </table>
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
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/forms/form-quill-editor.css') }}">
    <link href="https://unpkg.com/quill-better-table@1.2.8/dist/quill-better-table.css" rel="stylesheet">
    <!-- END: Page CSS-->
@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(document).ready(function(){
            $("#send-single-sms-by-phone").on('submit',function(e){
                e.preventDefault();

                let mobile      = $('[name="mobile"]').val();
                let contact     = $('[name="contact"] :selected').val();
                let message     = $('[name="message"]').val();
                let sms_count   = $("#sms_count").text();

                if(mobile != "" && contact != ""){
                    toastr.error('provide mobile number either in input box or select from dropdown');
                    return false;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/send-single-sms-by-phone') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{mobile:mobile,message:message,sms_count:sms_count},
                    success:function(data)
                    {
                        //console.log(data);

                        if(data == "true"){
                            toastr.success('Message triggered successfully, will be send soon !!', 'Success');
                            return false;
                        }

                        if(data == "sms_count_bigger"){
                            $("#sms_count_bigger").removeAttr("style");
                            return false;
                        }

                        if(data == "exceeded"){
                            $("#exceeded").removeAttr("style");
                            return false;
                        }

                    }
                });

            });
        })
    </script>

@endsection
