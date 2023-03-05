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
                            <h2 class="content-header-title float-start mb-0">Manage Contact</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Manage Contact</li>
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
                                            <span style="float: right !important;"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-contact">Add Contact</button></span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-11">
                                            <div class="mb-1">
                                                <select class="form-select" name="group_id">
                                                    <option value="">Select Group</option>
                                                    @foreach($contacts as $contact)
                                                        <option value="{{ $contact->id }}">{{ $contact->group_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="mb-1">
                                                <button id="get-result" class="btn btn-primary ml-0">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-size-default d-inline-block">
                                        <!-- Modal -->
                                        <div class="modal fade text-start" id="add-contact" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel18">Create a group</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        {!! Form::open(['url' => 'add-contact-info', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}


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

                                </div>
                            </div>
                        </div>

                        <!-- Medal Card -->
                        <div class="col-xl-12 col-md-12 col-12" id="result">

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
    $('body').on('click','#get-result',function(e) {
        e.preventDefault();

        let group_id = $('[name="group_id"]').val();

        if(group_id == ""){
            alert('Please choose group first !!');
            return false;
        }

        // console.log(package_id);
        // return false;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/get-all-contact-by-group') }}",
            'type':'post',
            'dataType':'text',
            data:{group_id:group_id},
            success:function(data)
            {
                // console.log(data);
                // return false;

                $("#result").empty();
                $("#result").html(data);
            }
        });

    });

    $('body').on('click','.delete',function(e) {
        e.preventDefault();
        let package_id = $('[name="group_id"]').val();
        let contact_id = $(this).attr("href");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/delete-contact') }}",
            'type':'post',
            'dataType':'text',
            data:{contact_id:contact_id},
            success:function(data)
            {
                if(data == "true"){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        'url':"{{ url('/get-all-contact-by-group') }}",
                        'type':'post',
                        'dataType':'text',
                        data:{package_id:package_id},
                        success:function(data)
                        {
                        
                            $("#result").empty();
                            $("#result").html(data);
                            if(data == "true"){
                             toastr.success('Contact Number Delete Successfully !!', 'Success');
                        }
                        }
                    });

                }
            }
        });

    });

})
</script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable .mobile").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection
