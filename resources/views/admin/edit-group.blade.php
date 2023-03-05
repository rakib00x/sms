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
                            <h2 class="content-header-title float-start mb-0">Group</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Edit Group</li>
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

                                    {!! Form::open(['url' =>'updateGroupInfo','method' => 'post','class' => 'form form-vertical', 'files'=>'true']) !!}

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
                                            <label>Package</label>
                                            <input type="text" value="{{ $row->group_name }}" name="group_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label></label>
                                            <input type="hidden" value="{{ $row->id }}" name="_id">
                                            <input type="submit" value="UPDATE GROUP" class="btn btn-primary me-1">
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
