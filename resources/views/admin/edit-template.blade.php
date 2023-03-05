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
                            <h2 class="content-header-title float-start mb-0">Template</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Update Template</li>
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
                                                <div class="alert-body"><strong>Success !!</strong>  Template successfully updated</div>
                                            </div>

                                        </div>
                                    </div>

                                    {!! Form::open(['url' => 'update-template','method' => 'post','class' => 'form form-vertical', 'files'=>'true']) !!}
                                     <div class="col-12">
                                        <div class="mb-1">
                                            @if (count($errors) > 0)
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger" role="alert">
                                                        <div class="alert-body"><strong>Warning !!</strong> {{ $error }}</div>
                                                    </div>
                                                @endforeach
                                            @endif

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
                                    </div>
                                    

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Template Name</label>
                                            <input type="text" value="{{ $row->template_name }}" name="templateName" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="alert alert-primary" role="alert">
                                                <div class="alert-body">Template Content</div>
                                            </div>
                                            <textarea id="SmsPackContent" name="templateContent" class="form-control" rows="6">{!! $row->template_content !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" value="{{ $row->id }}" name="id">
                                            <input type="submit" value="UPDATE TEMPLATE" class="btn btn-success" />
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
<script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>

@endsection

