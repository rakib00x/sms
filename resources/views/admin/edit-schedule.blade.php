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

                                    {!! Form::open(['url' =>'update-schedule','method' => 'post','class' => 'form form-vertical', 'files'=>'true']) !!}

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
                                    @php
                                     $groups = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
                                    $templates = DB::table('templates')->where('added_by',Session::get('user_id'))->get();
                                    @endphp

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Choose Group</label>
                                            <select class="form-select" name="group_id">
                                                <option value="">Select Group</option>
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}"
                                                    <?php if($group->id == $schedule->group_id){echo "selected"; }else{echo "";} ?>>
                                                        <?php echo $group->group_name ; ?>
                                                    
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Choose Thempelte</label>
                                            <select class="form-select" name="template_id">
                                                <option value="">Select Group</option>
                                                @foreach($templates as $template)
                                                <option value="{{ $template->id }}"
                                                    <?php if($template->id == $schedule->template_id){echo "selected"; }else{echo "";} ?>>
                                                        <?php echo $template->template_name ; ?>
                                                    </option>
                                                @endforeach
                                            </select>
                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label>Schedule Time</label>
                                            <input type="text" id="fp-date-time" class="form-control flatpickr-date-time flatpickr-input active" name="schedule_time" value="{{ $schedule->schedule_time }}" placeholder="YYYY-MM-DD HH:MM" readonly="readonly" require>
                                        </div>
                                    </div

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label></label>
                                            <input type="hidden" value="{{ $schedule->id }}" name="id">
                                            <input type="submit" value="UPDATE Schdule" class="btn btn-primary me-1">
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
