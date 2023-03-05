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
                            <h2 class="content-header-title float-start mb-0">Report</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Single wise message report</li>
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

                                    {!! Form::open(['id'=>'get-single-wise-report','method' => 'post']) !!}
                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                            <label>From</label>
                                            <input type="text" id="from_date" class="form-control flatpickr-basic" value="{{ date('Y-m-d') }}">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label>To</label>
                                            <input type="text" id="to_date" class="form-control flatpickr-basic" value="{{ date('Y-m-d') }}" />
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label>Mobile</label>
                                            <input type="number" class="form-control" id="mobile" />
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label>Duration</label>
                                            <select class="form-select" id="filterVal">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="3days">Last 3 days</option>
                                                <option value="7days">Last 7 days</option>
                                                <option value="14days">Last 14 days</option>
                                                <option value="thismonth">This month</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="6month">Last 6 months</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastyear">Last year</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label></label>
                                            <input type="submit" value="Search" class="form-control btn btn-success btn-block" />
                                        </div>

                                    </div>
                                    {!! Form::close() !!}

                                    <div class="row">
                                        <div class="table-responsive" id="get_content">

                                        </div>
                                    </div>

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

@section('js')
    <script>

        $(function(){

            $("#filterVal").on('change',function(e){
                e.preventDefault();

                var selectValue = $(this).val();

                if(selectValue == 'today'){
                    $("#from_date").val("<?php echo date('d-m-Y'); ?>");
                    $("#to_date").val("<?php echo date('d-m-Y'); ?>");
                }else if(selectValue == 'yesterday'){
                    $("#from_date").val("<?php $today = date('Y-m-d'); echo date('d-m-Y', strtotime('-1 days', strtotime($today))); ?>");
                    $("#to_date").val("<?php echo date('d-m-Y', strtotime('-1 days', strtotime($today))); ?>");
                }else if(selectValue == '3days'){
                    $("#from_date").val("<?php $today = date('Y-m-d'); echo date('d-m-Y', strtotime('-3 days', strtotime($today))); ?>");
                    $("#to_date").val("<?php echo date('d-m-Y'); ?>");
                }else if(selectValue == '7days'){
                    $("#from_date").val("<?php $today = date('Y-m-d'); echo date('d-m-Y', strtotime('-7 days', strtotime($today))); ?>");
                    $("#to_date").val("<?php echo date('d-m-Y'); ?>");
                }else if(selectValue == '14days'){
                    $("#from_date").val("<?php $today = date('Y-m-d'); echo date('d-m-Y', strtotime('-14 days', strtotime($today))); ?>");
                    $("#to_date").val("<?php echo date('d-m-Y'); ?>");
                }else if(selectValue == 'thismonth'){
                    $("#from_date").val("<?php $m = date('m'); $y = date('Y'); echo '01'.'-'.$m.'-'.$y; ?>");
                    $("#to_date").val("<?php echo date('d-m-Y'); ?>");
                }else if(selectValue == 'lastmonth'){
                    $("#from_date").val("<?php $month = date('m')-01; $count = strlen($month); if($count>1){ $m = "";}else{ $m = '0'.$month; } $y = date('Y'); echo '01'.'-'.$month.'-'.$y; ?>");
                    $("#to_date").val("<?php $month = date('m')-01; $count = strlen($month); if($count>1){ $m = "";}else{ $m = '0'.$month; } $y = date('Y'); echo '31'.'-'.$month.'-'.$y; ?>");
                }else if(selectValue == '6month'){

                    $("#from_date").val("<?php $month = date('m')-06; $count = strlen($month); if($count>1){ $m = "";}else{ $m = '0'.$month; } $y = date('Y'); echo '01'.'-'.$month.'-'.$y; ?>");
                    $("#to_date").val("<?php $month = date('m')-01; $count = strlen($month); if($count>1){ $m = "";}else{ $m = '0'.$month; } $y = date('Y'); $dd =  $y.'-'.$m.'-'.'01'; $lastDate = date('t',strtotime($dd)); echo $lastDate.'-'.$month.'-'.$y; ?>");

                }else if(selectValue == 'thisyear'){
                    $("#from_date").val("<?php $y = date('Y'); echo '01'.'-'.'01'.'-'.$y; ?>");
                    $("#to_date").val("<?php $y = date('Y'); echo '31'.'-'.'12'.'-'.$y; ?>");
                }else{
                    $("#from_date").val("<?php $y = date('Y')-1; echo '01'.'-'.'01'.'-'.$y; ?>");
                    $("#to_date").val("<?php $y = date('Y')-1; echo '31'.'-'.'12'.'-'.$y; ?>");
                }

            })

            $("#get-single-wise-report").on('submit',function(e){
                e.preventDefault();

                let from_date   = $("#from_date").val();
                let to_date     = $("#to_date").val();
                let mobile      = $("#mobile").val();

                // console.log(dataString);
                // return false;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/get-single-wise-report') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{from_date:from_date,to_date:to_date,mobile:mobile},
                    success:function(data)
                    {
                        $("#get_content").empty();
                        $("#get_content").html(data);

                    }
                });

            });

        })
    </script>

    <script>
        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }
    </script>

@endsection
