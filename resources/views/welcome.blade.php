<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

        <title>Mamma's Kitchen</title>

        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/flexslider.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/pricing.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <style>
            @foreach ($sliders as $key=>$slider)
                .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key+1 }}) .item
                {
                    background: url('{{asset('uploads/sliders/'.$slider->image)}}');
                    background-size: cover;
                    background-position: bottom;
                }
            @endforeach
        </style>

        <script src="{{asset('frontend/js/jquery-1.11.2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend/js/jquery.flexslider.min.js')}}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                 animation: "slide",
                 controlsContainer: ".flexslider-container"
                });
            });
        </script>

        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var mapCanvas = document.getElementById('map-canvas');
                var mapOptions = {
                    center: new google.maps.LatLng(24.909439, 91.833800),
                    zoom: 16,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(mapCanvas, mapOptions)

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(24.909439, 91.833800),
                    title:"Mamma's Kitchen Restaurant"
                });

                // To add the marker to the map, call setMap();
                marker.setMap(map);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>


    </head>
    <body data-spy="scroll" data-target="#template-navbar">

        <!--== 4. Navigation ==-->
        <nav id="template-navbar" class="navbar navbar-default custom-navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Food-fair-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img id="logo" src="{{asset('frontend/images/Logo_main.png')}}" class="logo img-responsive">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="Food-fair-toggle">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about">about</a></li>
                        <li><a href="#pricing">pricing</a></li>
                        <li><a href="#reserve">reservation</a></li>
                        <li><a href="#contact">contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.row -->
        </nav>


        <!--== 5. Header ==-->
        <section id="header-slider" class="owl-carousel">
            @foreach ($sliders as $key=>$slider)
                <div class="item">
                    <div class="container">
                        <div class="header-content">
                            <h1 class="header-title">{{ $slider->title }}</h1>
                            <p class="header-sub-title">{{ $slider->sub_title }}</p>
                        </div> <!-- /.header-content -->
                    </div>
                </div>
            @endforeach
        </section>



        <!--== 6. About us ==-->
        <section id="about" class="about">
            <img src="{{asset('frontend/images/icons/about_color.png')}}" class="img-responsive section-icon hidden-sm hidden-xs">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row dis-table">
                        @foreach ($abouts as $about)
                            <style>
                                    .about-bg
                                    {
                                        background: url('{{ asset('uploads/abouts/'.$about->image) }}');
                                        background-repeat: no-repeat;
                                        background-size: 85%;
                                        background-position-x: 15%;
                                        background-position-y: 80%;
                                    }
                            </style>
                        @endforeach
                            <div class="hidden-xs col-sm-6 section-bg about-bg dis-table-cell">
                            </div>
                        <div class="col-xs-12 col-sm-6 dis-table-cell">
                            <div class="section-content">
                                <h2 class="section-content-title">About us</h2>
                                @foreach ($abouts as $about)
                                    <p class="section-content-para">{{ $about->about }}</p>
                                @endforeach
                            </div> <!-- /.section-content -->
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.container-fluid -->
            </div> <!-- /.wrapper -->
        </section> <!-- /#about -->


        <!--==  7. Afordable Pricing  ==-->
        <section id="pricing" class="pricing">
            <div id="w">
                <div class="pricing-filter">
                    <div class="pricing-filter-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="section-header">
                                        <h2 class="pricing-title">Affordable Pricing</h2>
                                        <ul id="filter-list" class="clearfix">
                                                <li class="filter" data-filter="all">All</li>
                                            @foreach ($categories as $category)
                                                <li class="filter" data-filter="#{{ $category->slug }}">
                                                    {{ $category->name }}
                                                    <span class="badge">{{ $category->items->count() }}</span>
                                                </li>
                                            @endforeach
                                        </ul><!-- @end #filter-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">  
                        <div class="col-md-10 col-md-offset-1">
                            <ul id="menu-pricing" class="menu-price">
                                @foreach ($items as $item)
                                    <li class="item" id="{{ $item->category->slug }}">
                                        <a href="#">
                                            <img src="{{asset('uploads/items/'.$item->image)}}" class="" height="250" width="300" alt="Food" >
                                            <div class="menu-desc text-center">
                                                <span>
                                                    <h3>{{ $item->name }}</h3>
                                                    <p>{{ $item->description }}</p>
                                                </span>
                                            </div>
                                        </a>
                                        <h4 class="white">৳{{ $item->price }}</h4>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- <div class="text-center">
                                    <a id="loadPricingContent" class="btn btn-middle hidden-sm hidden-xs">Load More <span class="caret"></span></a>
                            </div> -->

                        </div>   
                    </div>
                </div>

            </div> 
        </section>






<section class="reservation" id="reserve">
    <img class="img-responsive section-icon hidden-sm hidden-xs" src="{{asset('frontend/images/icons/reserve_color.png')}}">
    <div class="wrapper">
        <div class="container-fluid" style="background-image: url({{ asset('frontend/images/2.jpg') }});">
        <h1 class="text-center display-4">Reserve A Table !</h1>
            <div class=" section-content">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        <form class="reservation-form" method="POST" action="{{ route('reservation.reserve') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        @error('name')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input type="text" class="form-control @error('name') is-invalid @enderror reserve-form empty iconified" name="name" id="name" placeholder="  &#xf007;  Name">
                                    </div>
                                    <div class="form-group">
                                        @error('email')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror reserve-form empty iconified" id="email" placeholder="  &#xf1d8;  e-mail">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        @error('phone')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror reserve-form empty iconified" name="phone" id="phone" placeholder="  &#xf095;  Phone">
                                    </div>
                                    <div class="form-group">
                                        @error('date_and_time')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input type="text" class="form-control @error('date_and_time') is-invalid @enderror reserve-form empty iconified" name="date_and_time" id="dateandtimepicker" placeholder="&#xf017;  Time">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                        @error('message')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                    <textarea type="text" name="message" class="form-control @error('message') is-invalid @enderror reserve-form empty iconified" id="message" rows="3" placeholder="  &#xf086;  We're listening"></textarea>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" id="submit" name="submit" class="btn btn-reservation">
                                        <span><i class="fa fa-check-circle-o"></i></span>
                                        Make a reservation
                                    </button>
                                </div>
                                    
                            </div>
                        </form>
                    </div>

                    <div class="col-md-2 hidden-sm hidden-xs"></div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="opening-time">
                            <h3 class="opening-time-title">Hours</h3>
                            <p>Mon to Fri: 7:30 AM - 11:30 AM</p>
                            <p>Sat & Sun: 8:00 AM - 9:00 AM</p>

                            <div class="launch">
                                <h4>Lunch</h4>
                                <p>Mon to Fri: 12:00 PM - 5:00 PM</p>
                            </div>

                            <div class="dinner">
                                <h4>Dinner</h4>
                                <p>Mon to Sat: 6:00 PM - 1:00 AM</p>
                                <p>Sun: 5:30 PM - 12:00 AM</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>




        <section id="contact" class="contact">
            <div class="container-fluid color-bg">
                <div class="row dis-table">
                    <div class="hidden-xs col-sm-6 dis-table-cell">
                        <h2 class="section-title">Contact With us</h2>
                    </div>
                    <div class="col-xs-6 col-sm-6 dis-table-cell">
                        <div class="section-content">
                            <p>16th Birn street Get Plaza (4th floar) USA</p>
                            <p>+44 12 213584</p>
                            <p>example@mail.com </p>
                        </div>
                    </div>
                </div>
                <div class="social-media">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <ul class="center-block">
                                <li><a href="#" class="fb"></a></li>
                                <li><a href="#" class="twit"></a></li>
                                <li><a href="#" class="g-plus"></a></li>
                                <li><a href="#" class="link"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <div class="row">
                             <form class="contact-form" method="POST" action="{{ route('contact.message') }}">
                                @csrf
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        @error('name')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input  name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="  Name">
                                    </div>
                                    <div class="form-group">
                                        @error('email')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="  Email">
                                    </div>
                                    <div class="form-group">
                                        @error('subject')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                        <input name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="  Subject">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                        @error('message')
                                            <p class="text-danger font-weight-bold my-0">{{ $message }}</p>
                                        @enderror
                                    <textarea name="message" type="text" class="form-control @error('message') is-invalid @enderror" id="message" rows="7" placeholder="  Message"></textarea>
                                </div>

                                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-send">Send </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="copyright text-center">
                            <p>
                                &copy; Copyright, 2015 <a href="#">Your Website Link.</a> Theme by <a href="http://themewagon.com/"  target="_blank">ThemeWagon</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend/js/jquery.mixitup.min.js')}}" ></script>
        <script src="{{asset('frontend/js/wow.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend/js/jquery.hoverdir.js')}}"></script>
        <script type="text/javascript" src="{{asset('frontend/js/jQuery.scrollSpeed.js')}}"></script>
        <script src="{{asset('frontend/js/script.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error('{{ $error }}');
                </script>
            @endforeach
        @endif

        <script>
            $(function(){
                $("#dateandtimepicker").datetimepicker({
                    format: "dd MM yyy - HH:ii p",
                    showMeridian: true,
                    autoclose: true,
                    todayBtn: true,
                });
            });
            // $('#datetimepicker1').datetimepicker({
            //     //language:  'fr',
            //     weekStart: 1,
            //     todayBtn:  1,
            //     autoclose: 1,
            //     todayHighlight: 1,
            //     startView: 2,
            //     forceParse: 0,
            //     showMeridian: 1
            // });
        </script>
        {!! Toastr::message() !!} <!-- it is for the toaster notification -->
    </body>
</html>