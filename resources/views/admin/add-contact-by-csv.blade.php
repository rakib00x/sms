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
                                    <li class="breadcrumb-item">Add Contact By CSV File</li>
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

                                    <form method="post" action="{{ route('csvupload') }}" enctype="multipart/form-data">

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
                                                <label>Upload File</label>
                                                <input type="file" name="csvfile" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <div class="progress" style="height:30px !important;font-size:15px !important">
                                                    <div class="progress-bar bg-gradient-gplus" role="progressbar" style="width: 0%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <div id="success">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label></label>
                                                <input type="submit" value="SUBMIT" class="btn btn-primary me-1">
                                            </div>
                                        </div>

                                    </form>


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
        $(document).ready(function(){

            $('form').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');

                },
                success:function(data)
                {

                    // console.log(data);
                    // return false;

                    if(data.errors)
                    {
                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }

                    if(data.success)
                    {
                        $('.progress-bar').text('Leads successfully imported into database');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                    }

                }
            });

        });
    </script>
@endsection
