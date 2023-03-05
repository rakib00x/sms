@extends('admin.master-admin')
@section('content')
<style>
@media only screen and (max-width: 600px) {
.mob{
   display:none;
}  
    
}
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <div class="content-body">

            <div class="row">
                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('my-contact') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/plus.png') }}" alt="">
                        <p class="text-icon">My Contact</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4 mob">
                    <?php
                    function isMobile() {
                        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
                    }
                    if(isMobile()){ ?>
                        <a class="text-anchor" href="{{ URL::to('get-file-upload-by-apps') }}">
                            <img class="desktop-icon" src="{{ URL::to('public/images/icon/xls.png') }}" alt="">
                            <p class="text-icon">Excel {{ Session::get('user_id') }}</p>
                        </a>
                    <?php }else{ ?>
                        <a class="text-anchor" href="{{ URL::to('file-upload') }}">
                            <img class="desktop-icon" src="{{ URL::to('public/images/icon/xls.png') }}" alt="">
                            <p class="text-icon">Excel {{ Session::get('user_id') }}</p>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-lg-1 col-md-6 col-4 mob">
                    <?php
                    if(isMobile()){ ?>
                        <a class="text-anchor" href="{{ URL::to('get-file-upload-by-apps') }}">
                            <img class="desktop-icon" src="{{ URL::to('public/images/icon/text.png') }}" alt="">
                            <p class="text-icon">Text {{ Session::get('user_id') }}</p>
                        </a>
                    <?php }else{ ?>
                        <a class="text-anchor" href="{{ URL::to('file-upload') }}">
                            <img class="desktop-icon" src="{{ URL::to('public/images/icon/text.png') }}" alt="">
                            <p class="text-icon">Text {{ Session::get('user_id') }}</p>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('manage-group') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/plus.png') }}" alt="">
                        <p class="text-icon">ADD Group</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('manage-template') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/plus.png') }}" alt="">
                        <p class="text-icon">ADD Template</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('manage-contact') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/plus.png') }}" alt="">
                        <p class="text-icon">ADD Contact</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('send-single-sms') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/email.png') }}" alt="">
                        <p class="text-icon">Manually</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('send-group-sms') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/schedulesms.png') }}" alt="">
                        <p class="text-icon">Group</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('group-wise-report') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/schedulesms.png') }}" alt="">
                        <p class="text-icon">Group Wise Report</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('group-wise-report') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/schedulesms.png') }}" alt="">
                        <p class="text-icon">Single Wise Report</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-6 col-4">
                    <a class="text-anchor" href="{{ URL::to('set-schedule') }}">
                        <img class="desktop-icon" src="{{ URL::to('public/images/icon/schedulesms.png') }}" alt="">
                        <p class="text-icon">Schedule</p>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
