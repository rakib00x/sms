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
                            <h2 class="content-header-title float-start mb-0">Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Admin</li>
                                    <li class="breadcrumb-item">Profile</li>
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

                                    {!! Form::open(['url' => 'update-admin-profile', 'method' => 'post', 'class' => 'form form-vertical', 'files'=>'true']) !!}

                                    <div class="row">

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
                                                <label class="form-label">Admin Name</label>
                                                <input type="text" value="{{ $admin_info->name }}" class="form-control" name="name" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label">E-mail Address</label>
                                                <input type="text" value="{{ $admin_info->email }}" class="form-control" name="email" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-vertical">Mobile</label>
                                                <input type="text" value="{{ $admin_info->mobile }}" class="form-control" name="mobile" />
                                            </div>
                                        </div>

                                        <div class="col-12" style="display: <?php function isMobileOne() { return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); } if(isMobileOne()){ echo 'none;'; }else{ echo ''; } ?>">
                                            <div class="mb-1">
                                                <img src="{{ URL::to('frontend/admin') }}/{{ $admin_info->photo }}" width="100" height="100" class="img-thumbnail" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12" style="display: <?php function isMobileTwo() { return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); } if(isMobileTwo()){ echo 'none;'; }else{ echo ''; } ?>">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-vertical">Choose Photo</label>
                                                <input type="file" id="first-name-vertical" class="form-control" name="photo" placeholder="First Name" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <input type="hidden" name="_id" value="{{ $_id }}">
                                            <button type="submit" class="btn btn-danger me-1">Update</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
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
