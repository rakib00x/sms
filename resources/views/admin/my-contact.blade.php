@extends('admin.master-admin')
@section('content')
<style>
@media only screen and (max-width: 600px) {
  #myInput{
    max-width:130px;
}

}

</style>
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
                                    <li class="breadcrumb-item">My Contact</li>
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
                                   <h3 class="text-center">Selected: <span id="selected"></span></h3>

                                    {!! Form::open(['id' => 'send-my-contact', 'method' => 'post','role' => 'form', 'files'=>'true']) !!}

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <table class="table table-striped" id="table-2">

                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="form-check-input" style="margin-left: -18px;" id="checkedAll">&nbsp;&nbsp; Select All <input class="form-control-sm" id="myInput" type="text" placeholder="Search.."></th>
                                                </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                <?php $i=1; foreach($contacts as $contact) { ?>
                                                <tr>
                                                    <td><input type="checkbox" class="checkSingle form-check-input" value="{{ $contact->mobile }}">&nbsp;&nbsp;{{ $contact->name }} - {{ $contact->mobile }}</td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="alert alert-primary" role="alert">
                                                <div class="alert-body">Write Message</div>
                                            </div>
                                            <textarea id="SmsPackContent" name="message" class="form-control" rows="6" placeholder="Write your message here"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="SEND MESSAGE" class="btn btn-danger" />
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
                </section>
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('public/backend/app-assets/css/plugins/forms/form-quill-editor.css') }}">
    <link href="https://unpkg.com/quill-better-table@1.2.8/dist/quill-better-table.css" rel="stylesheet">
    <!-- END: Page CSS-->
@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ URL::to('public/backend/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ URL::to('public/backend/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
    <!-- END: Page JS-->
    <script>
        $(document).ready(function() {
            $("#checkedAll").change(function(){
                if(this.checked){
                    $(".checkSingle").each(function(){
                        this.checked=true;
                    })
                }else{
                    $(".checkSingle").each(function(){
                        this.checked=false;
                    })
                }
            });

            $(".checkSingle").click(function () {
                if ($(this).is(":checked")){
                    var isAllChecked = 0;
                    $(".checkSingle").each(function(){
                        if(!this.checked)
                            isAllChecked = 1;
                    });
                    if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
                }else {
                    $("#checkedAll").prop("checked", false);
                }

                let selected = $('input:checkbox:checked').length;

                $('#selected').empty();
                $('#selected').append(selected);

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#send-my-contact").on('submit',function(e){
                e.preventDefault();

                var arr = [];
                $('input.checkSingle:checkbox:checked').each(function () {
                    arr.push($(this).val());
                });

                let message = $('[name="message"]').val();
                let sms_count = $("#sms_count").text();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    'url':"{{ url('/send-my-contact') }}",
                    'type':'post',
                    'dataType':'text',
                    data:{arr:arr,message:message,sms_count:sms_count},
                    success:function(data)
                    {
                        console.log(data);
                        return false;

                        if(data == "true"){
                            $("#notification").removeAttr("style");
                            return false;
                        }

                        if(data == "sms_count_bigger"){
                            $("#sms_count_bigger").removeAttr("style");
                            return false;
                        }

                        if(data == "exceeded"){
                            $("#exceeded").removeAttr("style");
                            return false;
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
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection
