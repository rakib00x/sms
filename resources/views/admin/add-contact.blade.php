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
                            <h2 class="content-header-title float-start mb-0">Contact</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Add Contact</li>
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
                                                <div class="alert-body"><strong>Success:</strong> the contact added successfully !!</div>
                                            </div>

                                        </div>
                                    </div>

                                    {!! Form::open(['url' => 'add-contact-info', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

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
                                            <label>Group Name</label>
                                            <select class="form-select" name="group_id">
                                                <option value="">Select Group</option>
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Contact Person's Name</label>
                                            <input type="text" placeholder="Full Name" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Mobile</label>
                                            <input type="text" placeholder="Mobile" name="mobile" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>E-mail Address</label>
                                            <input type="text" placeholder="E-mail Address" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Occupation</label>
                                            <input type="text" placeholder="Occupation" name="occupation" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Designation</label>
                                            <input type="text" placeholder="Designation" name="designation" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Institute</label>
                                            <input type="text" placeholder="Institute" name="institute" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="alert alert-primary" role="alert">
                                                <div class="alert-body">Location</div>
                                            </div>
                                            <textarea name="location" class="form-control" rows="6" placeholder="Location"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Relation</label>
                                            <input type="text" placeholder="Relation" name="relation" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="SAVE CONTACT" class="btn btn-success" />
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
@endsection
