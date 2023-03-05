@extends('frontend.master')
@section('title', 'sms')
@section('main')

<section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">GP</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Robi</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Bangalink</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-contact" aria-selected="false">Aritel</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Price</th>
                                            <th>SMS</th>
                                            <th>Validity</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <td><a href="#">10</a></td>
                                            <td>50</td>
                                            <td>7day</td>
                                            <td>*56543*89#</td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Price</th>
                                            <th>SMS</th>
                                            <th>Validity</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                          <td><a href="#">10</a></td>
                                            <td>50</td>
                                            <td>7day</td>
                                            <td>*56543*89#</td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                           <th>Price</th>
                                            <th>SMS</th>
                                            <th>Validity</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                        <tr>
                                              <td><a href="#">10</a></td>
                                            <td>50</td>
                                            <td>7day</td>
                                            <td>*56543*89#</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Price</th>
                                            <th>SMS</th>
                                            <th>Validity</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">10</a></td>
                                            <td>50</td>
                                            <td>7day</td>
                                            <td>*56543*89#</td>
                                        </tr>
                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection