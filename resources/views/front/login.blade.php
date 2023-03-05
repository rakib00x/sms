<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ URL::to('public/backend/affiliate/style.css') }}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>

        body {
            height: 100vh;
            margin: 0;
            background-image: url("{{ URL::to('public/backend/affiliate/assets/img/bg1.jpg') }}");
            background-repeat: no-repeat;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login_area a {
            color: #92badd;
            display:inline-block;
            text-decoration: none;
            font-weight: 400;
        }

        .login_area h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            display:inline-block;
            margin: 40px 8px 10px 8px;
            color: #cccccc;
        }



        /* STRUCTURE */

        .login_area .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
            width: 100%;
            padding-top: 50px;
        }

        .login_area #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            text-align: center;
        }

        .login_area #formFooter {
            background-color: #f6f6f6;
            border-top: 1px solid #dce8f1;
            padding: 25px;
            text-align: center;
            -webkit-border-radius: 0 0 10px 10px;
            border-radius: 0 0 10px 10px;
        }
        .login_area .login_area .text p {
            margin-top: 35px;
        }


        /* TABS */

        .login_area h2.inactive {
            color: #cccccc;
        }

        .login_area h2.active {
            color: #0d0d0d;
            border-bottom: 2px solid #5fbae9;
        }



        /* FORM TYPOGRAPHY*/

        .login_area input[type=button], input[type=submit], input[type=reset]  {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 80px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
            margin: 5px 20px 40px 20px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .login_area input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
            background-color: #39ace7;
        }

        .login_area input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
        }

        .login_area input[type=text] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 0;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 90%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
        }

        .login_area input[type=text]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
        }

        .login_area input[type=text]:placeholder {
            color: #cccccc;
        }



        /* ANIMATIONS */

        /* Simple CSS3 Fade-in-down Animation */
        .login_area .fadeInDown {
            -webkit-animation-name: fadeInDown;
            animation-name: fadeInDown;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }
            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }
            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        /* Simple CSS3 Fade-in Animation */
        @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

        .login_area .fadeIn {
            opacity:0;
            -webkit-animation:fadeIn ease-in 1;
            -moz-animation:fadeIn ease-in 1;
            animation:fadeIn ease-in 1;

            -webkit-animation-fill-mode:forwards;
            -moz-animation-fill-mode:forwards;
            animation-fill-mode:forwards;

            -webkit-animation-duration:1s;
            -moz-animation-duration:1s;
            animation-duration:1s;
        }

        .login_area .fadeIn.first {
            -webkit-animation-delay: 0.4s;
            -moz-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }
        .login_area .fadeIn.first img{
            height: 100px;
            width: 100px;
            margin-top: 30px;
            border-radius: 5px;
        }
        .login_area .fadeIn.first h3{
            text-align: center;
            font-style: italic;
            font-size: 14px;
            color: #b0b0b0;
            letter-spacing: 1px;
        }

        .login_area .fadeIn.second {
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }

        .login_area .fadeIn.third {
            -webkit-animation-delay: 0.8s;
            -moz-animation-delay: 0.8s;
            animation-delay: 0.8s;
        }

        .login_area .fadeIn.fourth {
            -webkit-animation-delay: 1s;
            -moz-animation-delay: 1s;
            animation-delay: 1s;
        }

        /* Simple CSS3 Fade-in Animation */
        .login_area .underlineHover:after {
            display: block;
            left: 0;
            bottom: -10px;
            width: 0;
            height: 2px;
            background-color: #56baed;
            content: "";
            transition: width 0.2s;
        }

        .login_area .underlineHover:hover {
            color: #0d0d0d;
        }

        .login_area .underlineHover:hover:after{
            width: 100%;
        }
        .login_area .fadeIn.fourth {
            width: 91%;
        }


        /* OTHERS */

        *:focus {
            outline: none;
        }

        .login_area #icon {
            width:60%;
        }

    </style>
</head>
<body>
<div class="login_area">

    <!------ Include the above in your HEAD tag ---------->

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <a href="index.html"><img src="{{ URL::to('public/backend/affiliate/assets/img/websitelogo.png') }}" alt="image not found"></a>
                <h3>Affiliate Login</h3>
            </div>

            <!-- Login Form -->
            {!! Form::open(['url' =>'user-authentication','method' => 'post','role' => 'form', 'files'=>'true']) !!}
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="e-mail">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Log In">
            {!! Form::close() !!}

            <!-- Remind Passowrd -->
            <div id="formFooter">

                <?php
                if(Session::get('failed') != null) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
                    <strong><?php echo Session::get('failed') ; ?></strong>
                    <?php echo Session::put('failed',null) ; ?>
                </div>
                <?php } ?>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif

                <a class="underlineHover" href="{{ URL::to('affiliate-registration') }}">Don't have an account? Register now.</a>
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>
            <div class="text">
                <p>MaxBounty Inc. [3]</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
