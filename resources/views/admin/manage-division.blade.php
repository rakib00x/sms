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
                            <h2 class="content-header-title float-start mb-0">Division</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Manage Division</li>
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

                                    <div class="row">
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            <span style="float: right !important;"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-template">Add Division</button></span>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Division Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($division as $divsion)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{$divsion->div_name }}</td>
                                                    <td><a href="{{ URL::to('edit-division') }}/{{ $divsion->id }}" class="btn btn-warning">Edit</a></td>
                                                    <td><a onclick="return confirm('Are you Sure to Delete it ?')"  href="{{ URL::to('delete-division') }}/{{ $divsion->id }}" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-size-default d-inline-block">
                                        <!-- Modal -->
                                        <div class="modal fade text-start" id="add-template" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel18">Create a Division</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">

                                        {!! Form::open(['id' => 'store-division', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}
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
                                                    <label>Division</label>
                                                    <input class="form-control" type="text" name="div_name"/>
                                                </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="submit" value="SAVE Division" class="btn btn-success" />
                                                            </div>
                                                        </div>

                                                        {!! Form::close() !!}

                                                </div>
                                            </div>
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

  $("#store-division").on('submit',function(e){
            e.preventDefault();

            var country_id = $('[name="country"] :selected').val();
            var div_name = $('[name="div_name"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/store-division') }}",
                'type':'post',
                'dataType':'text',
                data:{country_id:country_id,div_name:div_name},
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success:function(data)
                {
                    if(data == 'true'){
                        toastr.success('Division added successfully', 'Success');
                        // alert('Division added successfully');
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
