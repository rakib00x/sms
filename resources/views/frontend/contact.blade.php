@extends('frontend.master')
@section('title', 'sms')
@section('main')
<section class="section-padding-ash">
  <div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="contact-info-box">
              <h2>Office Address:</h2>
              <div class="contact-info">
                <i class="icofont-google-map"></i>
                <p> House-19, Sectore-7,Uttara Dhaka.</p>
              </div>
              <div class="contact-info">
                <i class="icofont-envelope"></i>
                <p>Email: info@availtrade.com</p>
              </div>
              <div class="contact-info">
                <i class="icofont-ui-call"></i>
                <p>Contact: 01730475757</p>
              </div>
              <div class="contact-info">
                <i class="icofont-web"></i>
                <p>Website: www.availtrade.com</p>
              </div>
             
            </div>
          </div>
        <div class="col-md-6 col-lg-8">
            <div class="contact-form">
              <h2>Send us A Message</h2>
              <form class="contactform" method="post" action="" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Name" name="name" class="validate form-control" required="">
                      <span class="input-focus-effect"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" placeholder="Email" name="email" class="validate form-control" required="">
                      <span class="input-focus-effect"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Subject" name="subject" class="validate form-control" required="">
                      <span class="input-focus-effect"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Phone" name="phone" class="validate form-control" required="">
                      <span class="input-focus-effect"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea placeholder="Your Comment" name="message" class="form-control" required=""></textarea>
                      <span class="input-focus-effect"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="send">
                      <button class="btn btn-lg btn-green" type="submit" name="send"> Send Message</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>    
  </div>
</section>
@endsection