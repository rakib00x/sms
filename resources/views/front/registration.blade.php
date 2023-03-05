<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin: 0;
        }
        .reg{
            height: 100vh;
        }
        .reg .left{
            width: 40%;
            float: left;
            background-color: #000;
            height: 100vh;
            padding-top: 15%;
        }
        .reg .left .top_main{
            width: 80%;
            margin: auto;
        }
        .reg .left h1{
            color: #fff;
            font-size: 40px;
            text-align: center;
            padding-bottom: 10px;
        }
        .reg .left p{
            color: #fff;
            width: 90%;
            text-align: center;
            margin: auto;
        }
        .reg .left p a{
            text-decoration: none;
            color: #0069D9;
        }
        .reg .right .main_are{
            width: 50%;
            margin: auto;
            text-align: center;
        }
        .reg .right{
            width: 60%;
            overflow: hidden;
            padding-top: 7%;
        }
        .reg .right img{
            height: 100px;
            width: 100px;
            border-radius: 5px;
            margin: auto;
            display: block;
        }
        .reg .right p{

        }
        .reg .right p.btop{
            border-top: 5px solid #000;
            padding: 20px 0;
            text-align: center;
        }
        .reg .right button{

        }
        .reg .right .btnone {
            background: #4E555A;
            border: transparent;
            padding: 14px 0;
            width: 49%;
            color: #fff;
            font-size: 18px;
            border-radius: 5px;
            margin-right: 2%;
            overflow: hidden;
            float: left;
        }
        .reg .right .btntwo{
            background: #0069D9;
            border: transparent;
            padding: 14px 0;
            width: 49%;
            color: #fff;
            font-size: 18px;
            overflow: hidden;
            border-radius: 5px;
        }
        .reg .right a{
            display: block;
            color: #007bff;
            text-decoration: none;
            text-align: center;
        }
        .reg .right .btnsubmit .btntextt a{
            background-color: #04AA6D;
            color: #ffffff;
            border: none;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        .reg .right .btext{
            color: #6c757d;
            text-align: center;
        }
        .reg .right .btnsubmit{
            overflow: hidden;
        }
        .reg .right .btnsubmit .btntextt{
            margin-bottom: 50px;
        }

        .reg .right #regForm {
            background-color: #ffffff;
            margin: 0 auto;
            font-family: Raleway;
            padding: 0;
            width: 60%;
            min-width: 300px;
        }

        .reg .right h1 {
            text-align: center;
        }

        .reg .right input {
            padding: 10px 0 10px 10px;
            width: 98%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }
        .reg .right label {
            margin-bottom: 5px;
            display: block;
        }
        /* Mark input boxes that gets an error on validation: */
        .reg .right input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        .reg .right button {
            background-color: #04AA6D;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
            width: 49%;
        }

        .reg .right button:hover {
            opacity: 0.8;
        }

        .reg .right select {
            width: 100%;
            padding: 12px 0;
            background-color: transparent;
            border: 1px solid #aaaaaa;
            font-size: 17px;
            color: #574f4f;
        }

        .reg .right #prevBtn {
            background-color: #bbbbbb;
            width: 49%;
        }

        /* Make circles that indicate the steps of the form: */
        .reg .right .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .reg .right .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .reg .right .step.finish {
            background-color: #04AA6D;
        }


        @media screen and (max-width: 992px) {
            .reg .left {
                display: none;
            }
            .reg .right {
                width: 100%;
            }
        }

    </style>
</head>
<body>
<div class="reg">
    <div class="left">
        <div class="top_main">
            <h1>Affiliate Registration</h1>
            <p>Become a MaxBounty affiliate and gain access to thousands of campaigns from hundreds of advertisers, bonus earnings, contests and more.</p>
            <p>Increase your chances of approval. Read our step-by-step application guide <a href="#">here</a>.</p>
        </div>
    </div>
    <div class="right">

        <!-- One "tab" for each step in the form: -->
        {!! Form::open(['url' => 'add-members','method' => 'post','id' => 'regForm','files'=>'true']) !!}
            <a href="#"><img src="{{ URL::to('public/backend/affiliate/assets/img/websitelogo.png') }}" alt="image not found"></a>
            <p class="btop">Do you already have an account with MaxBounty?</p>
            <div class="tab">

            </div>
            <div class="tab">
                <p>
                    <label for="name">Name*</label>
                    <input id="name" type="text" placeholder="Name" oninput="this.className = ''" name="fname">
                </p>
                <p>
                    <label for="cname">Copmany Name*</label>
                    <input id="cname" type="text" placeholder="Copmany Name" oninput="this.className = ''" name="lname">
                </p>
                <p>
                    <label for="email">Email*</label>
                    <input id="email" type="email" placeholder="Email" oninput="this.className = ''" name="email">
                </p>
            </div>
            <div class="tab">
                <p>
                    <label for="pass">Password*</label>
                    <input id="pass" type="Password" placeholder="Password" oninput="this.className = ''" name="pass">
                </p>
                <p>
                    <label for="rpass">Re-Enter Password*</label><br>
                    <input id="rpass" type="Password" placeholder="Re-Enter Password" oninput="this.className = ''" name="rpass">
                </p>
                <p>
                    <label for="security">Security Question*</label><br>
                    <select id="paymentmethod security" class="form-control" name="question1">
                        <option value="" selected=""></option>
                        <option value="1">What was the name of your first grade teacher?</option>
                        <option value="2">Who was your first kiss?</option>
                        <option value="3">What was the name of your first pet?</option>
                        <option value="4">Who was your childhood hero?</option>
                        <option value="5">What city were you born in?</option>
                    </select>
                </p>
                <p>
                    <label for="anwer">Anwer*</label>
                    <input id="anwer" type="text" placeholder="Anwer" oninput="this.className = ''" name="answer1">
                </p>
                <p>
                    <label for="securityy">Security Question 2*</label><br>
                    <select id="paymentmethod securityy" class="form-control" name="question2">
                        <option value="" selected=""></option>
                        <option value="6">What was your childhood nickname?</option>
                        <option value="7">What is the middle name of your oldest cousin?</option>
                        <option value="8">What was the first company you worked for?</option>
                        <option value="9">What was the house number of your childhood home?</option>
                        <option value="10">In what town or city did your mother and father meet?</option>
                    </select>
                </p>
                <p>
                    <label for="anwer1">Anwer*</label>
                    <input id="anwer1" type="text" placeholder="Anwer" oninput="this.className = ''" name="answer2">
                </p>
            </div>

            <div class="tab">
                <p>
                    <label for="mnumber">Mobile Phone Number*</label>
                    <input id="mnumber" type="tel" placeholder="+1" oninput="this.className = ''" name="mobile">
                </p>
                <p>
                    <label for="rmnumber">Alternate Phone Number (home, work etc.)</label><br>
                    <input id="rmnumber" type="tel" placeholder="+6" oninput="this.className = ''" name="alt_mobile">
                </p>
                <p>
                    <label for="securitty">Your Time Zone*</label><br>
                    <select id="paymentmethod securitty" class="form-control" name="timezone">
                        <option value="" selected="">Select Time Zone</option>
                        @foreach($timezones as $timezone)
                        <option value="{{ $timezone->id }}">{{ $timezone->timezone }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="securittyy">When can you be reached?*</label><br>
                    <select id="paymentmethod securittyy" class="form-control" name="reaching_time">
                        <option value="" selected=""></option>
                        <option value="1">Early Morning</option>
                        <option value="2">Late Morning</option>
                        <option value="3">Early Afternoon</option>
                        <option value="4">Late Afternoon</option>
                        <option value="5">Evening</option>
                    </select>
                </p>
                <p>
                    <label for="skype">What is your Skype handle?**</label>
                    <input id="skype" type="text" placeholder="Skype Handle" oninput="this.className = ''" name="skype">
                </p>
            </div>
            <div class="tab">
                <p>
                    <label for="address">Street Address*</label>
                    <input id="address" type="text" placeholder="Address" oninput="this.className = ''" name="address1">
                </p>
                <p>
                    <input id="address2" type="text" placeholder="Address" oninput="this.className = ''" name="address2">
                </p>
                <p>
                    <label for="city">City</label>
                    <input id="city" type="text" placeholder="City" oninput="this.className = ''" name="city">
                </p>
                <p>
                    <label for="securittyy">North American State/Province</label><br>
                    <select id="paymentmethod securittyy" class="form-control" name="north_american_state">
                        <option value="" selected=""></option>
                        @foreach($north_american_states as $north_american_state)
                        <option value="{{ $north_american_state->id }}">{{ $north_american_state->state_name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="anwer">Non-North American State/Province</label>
                    <input id="anwer" type="text" placeholder="State / Province" oninput="this.className = ''" name="north_american_state_answer">
                </p>
                <p>
                    <label for="securiittyy">Country*</label><br>
                    <select id="paymentmethod securiittyy" class="form-control" name="country">
                        <option value="">All Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->countryname }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="anwer">Zip / Postal Code*</label>
                    <input id="anwer" type="tel" placeholder="Zip / Postal Code" oninput="this.className = ''" name="zip_code">
                </p>
            </div>
            <div class="tab">
                <p>We require all of our affiliates to submit a piece of photo government identification. Please upload a photo of the front and back of a piece of identifcation stating your full name and address.</p>

                <label for="idcrd">Photo ID Front*</label>
                <input id="idcrd" type="file" oninput="this.className = ''" name="id_card_front" style="margin-bottom: 20px;">

                <label for="">Photo ID Back</label>
                <input id="idcrdb" type="file" oninput="this.className = ''" name="id_card_back" style="margin-bottom: 20px;">
            </div>
            <div class="btnsubmit">
                <div class="btntextt">
                    <button type="button" id="login"><a href="login.html">Yes</a></button>
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">No</button>
                </div>
            </div>
            <a href="{{ URL::to('affiliate-login') }}">Already have an account? Sign in now</a>
            <p class="btext">MaxBounty Inc.</p>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<script>

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("login").style.display = "inline";
        } else {
            document.getElementById("login").style.display = "none";
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }

        if (n == 0) {
            document.getElementById("nextBtn").innerHTML = "No";
        }

        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...

        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }

        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    {{--$('body').on('submit','.addMember',function(e) {--}}
    {{--    e.preventDefault();--}}

    {{--    console.log('yes');--}}

    {{--    var table = $('.addMember');--}}
    {{--    var form_data = new FormData(table);--}}

    {{--    $.ajaxSetup({--}}
    {{--        headers: {--}}
    {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--        }--}}
    {{--    });--}}

    {{--    $.ajax({--}}
    {{--        url:"{{ url('/add-members') }}",--}}
    {{--        type:'post',--}}
    {{--        dataType:'text',--}}
    {{--        contentType: false,--}}
    {{--        processData: false,--}}
    {{--        cache: false,--}}
    {{--        data:form_data,--}}
    {{--        success:function(data)--}}
    {{--        {--}}
    {{--            console.log(data);--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--    });--}}

    {{--})--}}

</script>

</body>
</html>
