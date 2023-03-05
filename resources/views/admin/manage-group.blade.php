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
                                    <li class="breadcrumb-item">Manage Group</li>
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
                                            <span style="float: right !important;"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-smartlink">Add Group</button></span>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Group Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1 ;
                                                foreach ($result as $value) { ?>
                                                <tr>
                                                    <td><?php echo $i++ ; ?></td>
                                                    <td><?php echo $value->group_name; ?></td>
                                                    <td><a href="{{ URL::to('edit-group') }}/{{ $value->id }}" class="btn btn-warning">Edit</a></td>
                                                    <td><a onclick="return confirm('Are you Sure to Delete it ?')" href="{{ URL::to('delete-group') }}/{{ $value->id }}" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-size-default d-inline-block">
                                        <!-- Modal -->
                                        <div class="modal fade text-start" id="create-smartlink" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel18">Create a group</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        {!! Form::open(['url' =>'addGroupInfo','method' => 'post','class' => 'form form-vertical', 'files'=>'true']) !!}

                                                        <div class="col-12">
                                                            <div class="mb-1">
                                                                <label>Group</label>
                                                                <input type="text" placeholder="Write Group Name" name="group_name" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-1">
                                                                <label></label>
                                                                <input type="submit" value="ADD GROUP" class="btn btn-primary me-1">
                                                            </div>
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

    <!-- JS Libraies -->
    <script src="{{ URL::to('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script>
        $(function(){

            $('body').on('click','.delete',function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this vertical!",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        var vertical_id = $(this).attr("href");

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            'url':"{{ url('/delete-vertical') }}",
                            'type':'post',
                            'dataType':'text',
                            data:{vertical_id:vertical_id},
                            success:function(data)
                            {
                                if(data == 'true'){
                                    swal("Success! Payment method has been deleted!", {
                                        icon: "success",
                                    }).then((vicetracking) => {
                                        window.location.reload();
                                    });
                                }else{
                                    swal("Something went wrong!");
                                }
                            }
                        });

                    } else {
                        swal("Your vertical is safe, not deleted!");
                    }

                });
            });

        })
    </script>
@endsection
