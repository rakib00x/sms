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
                            <h2 class="content-header-title float-start mb-0">Template</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Manage Template</li>
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
                                            <span style="float: right !important;"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-template">Add Template</button></span>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Template Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($templates as $template)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $template->template_name }}</td>
                                                    <td><a href="{{ URL::to('edit-template') }}/{{ $template->id }}" class="btn btn-warning">Edit</a></td>
                                                    <td><a onclick="return confirm('Are you Sure to Delete it ?')"  href="{{ URL::to('delete-template') }}/{{ $template->id }}" class="btn btn-danger">Delete</a></td>
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
                                                        <h4 class="modal-title" id="myModalLabel18">Create a group</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        {!! Form::open(['url' => 'add-template-info', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                                        <div class="col-12">
                                                            <div class="mb-1">
                                                                <label>Template Name</label>
                                                                <input type="text" placeholder="Template Name" name="templateName" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="alert alert-primary" role="alert">
                                                                    <div class="alert-body">Template Content</div>
                                                                </div>
                                                                <textarea id="SmsPackContent" name="templateContent" class="form-control" rows="6" placeholder="Write your message here"></textarea>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="submit" value="SAVE TEMPLATE" class="btn btn-success" />
                                                            </div>
                                                        </div>
                                              <div class="row section-space--pb_60 border-bottom-dash mt-2">
                                               <div class="col-md-12">
                                               <table align="center" style="width:100%">
                                                <tr>
                                                    <td width="50%" style="vertical-align: middle;">
                                                        <b><span id="sms_total_chars">0</span> characters=<span id="sms_count">0</span> SMS</b>
                                                    </td>
                                                    <td style="text-align:right;vertical-align: middle;" width="50%">
                                                        <span id="sms_charset">GSM 03.38</span> charset,<span id="sms_chars_left">160</span> left
                                                    </td>
                                                </tr>
                                               </table>
                                                <table cellpadding="4" cellspacing="4" align="center" width="100%" style="border:1px solid #cdcdcd;padding:10px">
                                                <tr>
                                                    <td><span style="padding-left:15px"><b>Detailed view of SMS buildup</b></span></td>
                                                 </tr>
                                                 <tr>
                                                    <td><div id="sms_details"></div></td>
                                                </tr>
                                              </table>
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
<script src="{{ URL::to('backend/assets/js/sweetalert.min.js') }}"></script>

<script>
$('body').on('click','#delete',function(e) {
    e.preventDefault();

    let template_id = $(this).attr("href");

    swal({
        title: "Are you sure?",
        text: "After click on Yes button the template will be deleted!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                'url':"{{ url('/delete-template') }}",
                'type':'post',
                'dataType':'text',
                data:{template_id:template_id},
                success:function(data)
                {
                    if(data == 'true'){
                        swal("Success! Template has been successfully deleted!", {
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
            swal("Sorry, your template has not deleted!");
        }
    });
});
</script>
@endsection
