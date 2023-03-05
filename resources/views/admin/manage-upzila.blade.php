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
                            <h2 class="content-header-title float-start mb-0">District</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Manage District</li>
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
                                            <span style="float: right !important;"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-template">Add District</button></span>
                                        </div>
                                    </div>
                                    <input class="form-control mt-1" id="myInput" type="text" placeholder="Search..">
                                    <div class="table-responsive mt-2">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>District Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody id="myTable">
                                                @php $i=1 @endphp
                                                @foreach($upzila as $upzilas)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{$upzilas->up_name }}</td>
                                                    <td><a href="{{ URL::to('edit-upzela') }}/{{ $upzilas->id }}" class="btn btn-warning">Edit</a></td>
                                                    <td><a onclick="return confirm('Are you Sure to Delete it ?')"  href="{{ URL::to('delete-upzila') }}/{{ $upzilas->id }}" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    <div class="d-felx justify-content-center">
                                         {{ $upzila->links() }}
                                    </div>
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

                                        {!! Form::open(['id' => 'store-district', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label>Country Name</label>
                                                        <select class="form-select select2" name="country">
                                                            <option value="">Select Country</option>
                                                            <?php foreach($countries as $country){ ?>
                                                            <option value="<?php echo $country->id; ?>"><?php echo $country->countryname ; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="mb-1">
                                                    <label>Choose Division</label>
                                                    <select class="form-select select2" name="division">
            
                                                    </select>
                                                </div>
            
                                                <div class="mb-1">
                                                    <label>Choose District</label>
                                                    <select class="form-select select2" name="district">
            
                                                    </select>
                                                </div>
            
                                                <div class="mb-1">
                                                    <label>Upzela</label>
                                                    <input class="form-control" type="text" name="upzela"/>
                                                </div>
            
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" value="SUBMIT" class="btn btn-success" />
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
        $('[name="country"]').change(function(e){
            e.preventDefault();

            var country_id = $('[name="country"] :selected').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/get-division-by-country') }}",
                'type':'post',
                'dataType':'text',
                data:{country_id:country_id},
                success:function(data)
                {
                    console.log(data);
                    $('[name="division"]').empty();
                    $('[name="division"]').html(data);
                }
            });
        })

        $('[name="division"]').change(function(e){
            e.preventDefault();

            var division_id = $('[name="division"] :selected').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/get-district-by-division') }}",
                'type':'post',
                'dataType':'text',
                data:{division_id:division_id},
                success:function(data)
                {
                    console.log(data);
                    $('[name="district"]').empty();
                    $('[name="district"]').html(data);
                }
            });
        })

        $("#store-upzela").on('submit',function(e){
            e.preventDefault();

            var district = $('[name="district"] :selected').val();
            var upzela = $('[name="upzela"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/store-upzela') }}",
                'type':'post',
                'dataType':'text',
                data:{district:district,upzela:upzela},
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success:function(data)
                {
                    if(data == 'true'){
                        toastr.success('Upzela added successfully', 'Success');
                        // alert('Upzela added successfully');
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
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endsection
