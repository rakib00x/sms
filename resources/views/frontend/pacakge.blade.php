@extends('frontend.master')
@section('title', 'sms')
@section('main')
<section class="section-padding-ash">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h2 class="text-center">SMS Price</h2>
          <hr/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          
          <div class="pricing-cont">
          <h5>Non Masking 1 </h5>
          <h6>0.20 BDT</h6>
          <ul>
            <li> Minimum Buy: 400Tk(2000 SMS)</li>
                    <li> <i class="icofont-check-alt">Sender Number : Multiple (Shared)</i> </li>
            <li><i class="icofont-check-alt">Send OTP : NO</i></li>
              <li><i class="icofont-check-alt"> HTTP API Access : Yes</i></li>
             <li> <i class="icofont-check-alt">Can Change Package: Yes</i> </li>
            <li> <i class="icofont-check-alt">Wordpress SMS Plugin : Yes</i> </li>
            <li> <i class="icofont-check-alt">Fast Delivery Speed</i> </li>
            <li><i class="icofont-check-alt">Delivery Report: Yes</i> </li>
           <li> <i class="icofont-check-alt"> Validity :1y to 5Years</i> </li>
        <li> <i  class="icofont-check-alt">Number Formats Support: Multiple</i> </li>
              <li> <i class="icofont-check-alt"> XLS to SMS : Yes</i> </li>
              <li> <i class="icofont-check-alt"> Dynamic SMS : Yes</i> </li>
               <li><i class="icofont-check-alt"> Group SMS : Yes</i> </li>
                <li> <i class="icofont-check-alt"> Online Payment (Bkash Auto):Yes</i></li>
          </ul>
          <a class="btn btn-lg btn-green wow tada" href="href="{{route('terms')}}>Buy Now</a> </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="pricing-cont">
           <h5>Non Masking 2</h5>
     <h6>Buy 2000(sms)  <small>0.25 BDT </small></h6>
             <h6>Buy 50000(sms)  <small>0.22 BDT </small></h6>
              <h6>Buy 100000(sms)  <small>0.20 BDT </small></h6>
          <ul>
           <li>Minimum Buy: 2000 SMS (600Tk)</li>
         <li> <i class="icofont-check-alt"> Sender Number : Fixed</i> </li>
         <li><i class="icofont-check-alt">Send OTP : Yes</i></li>
         <li><i class="icofont-check-alt"> HTTP API Access : Yes</i></li>
           <li> <i class="icofont-check-alt">Can Change Package : Yes</i> </li>
           <li> <i class="icofont-check-alt">Wordpress SMS Plugin : Yes</i> </li>
            <li><i class="icofont-check-alt">Fast Delivery Speed: Yes </i></li>
            <li><i class="icofont-check-alt">  Delivery Report: Yes</i></li>
             <li> <i class="icofont-check-alt"> Validity : 6 Month</i></li>
          <li> <i  class="icofont-check-alt">Number Formats Support: Multiple</i> </li>
              <li> <i class="icofont-check-alt"> File to SMS : Yes</i></li>
               <li><i class="icofont-check-alt"> Group SMS : Yes</i></li>
                <li><i  class="icofont-check-alt"> Dynamic SMS : Yes (From CSV)</i></li>
                 <li> <i class="icofont-check-alt"> Online Payment (Bkash Auto):Yes</i></li>
          </ul>
           <a class="btn btn-lg btn-green wow tada" href="href="{{route('terms')}}">Buy Now</a> </div>
      </div>
           <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="pricing-cont">
          <h5>Masking Per SMS</h5>
           <h2>0.50 BDT</h2>
            <h6>Buy 10000(sms)  <small>0.50 BDT </small></h6>
            <h6>Buy 50000(sms)  <small>0.48 BDT </small></h6>
             <h6>Buy 100000(sms)  <small>0.45 BDT </small></h6>
          <ul>
           <li>Minimum Buy: 10000 SMS (5000Tk)</li>
           <li> <i  class="icofont-check-alt"> Masking Sender ID: Yes</i> </li>
            <li> <i  class="icofont-check-alt"> Masking Approval Time: 7 Working Days </i> </li>
            <li> <i class="icofont-check-alt"> Super Fast Delivery Speed</i></li>
        <li><i class="icofont-check-alt"> HTTP API Access : Yes</i></li>
            <li> <i class="icofont-check-alt"> Delivery Report: Yes</i></li>
            <li> <i class="icofont-check-alt"> Validity : 2 Years</i></li>
         <li> <i  class="icofont-check-alt">Number Formats Support: Multiple</i> </li>
            <li> <i class="icofont-check-alt"> XLS to SMS : Yes</i></li>
            <li><i  class="icofont-check-alt"> Group SMS : Yes</i></li>
            <li><i  class="icofont-check-alt"> Dynamic SMS : Yes</i></li>
           <li> <i class="icofont-check-alt"> Online Payment (Bkash Auto):Yes</i></li>
          </ul>
          <a class="btn btn-lg btn-green wow tada" href="{{route('terms')}}">Buy Now</a> </div>
      </div>
         </div>
         </div>
         
</section>
@endsection