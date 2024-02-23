<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="public/assets_landingpage/images/favicon.png" type="">

    <!-- bootstrap core css -->
    {{-- <link rel="stylesheet" type="text/css" href="public/assets_landingpage/css/bootstrap.css" /> --}}
    <link rel="stylesheet" type="text/css" href="public/assets_landingpage/css/bootstrap.min.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="public/assets_landingpage/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Custom styles for this template -->
    <!-- responsive style -->
    <link href="public/assets_landingpage/css/responsive.css" rel="stylesheet" />
    <link href="public/assets_landingpage/css/style.css" rel="stylesheet" />

    <title> Fishmarket Mandar @yield('title')</title>
    <style>
        .bottom-right-button {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 1000;
            /* Ensure it appears above other elements */
        }

        button {
            width: 40px;
            height: 40px;
            border-radius: 100%;
            background: #ffbe33;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            color: white
        }

        button svg {
            color: #fff;
        }

        .order-card {
            height: auto;
            border: 1px solid hsl(41, 50%, 70%);
            border-radius: 10px;
            margin-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 1fr;
            grid-column-gap: 0px;

        }

        .order-card img {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 2px;
            margin: auto;
            grid-area: 1 / 1 / 2 / 2;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            margin: 0 5px;
            font-size: 16px;
        }

        .order-details {
            /* flex: 1; */
            padding: 10px;
            display: grid;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: 1fr;
            grid-column-gap: 0px;
            align-items: center;
            grid-area: 1 / 2 / 2 / 5;
        }

        .order-name {
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 767px) {
            .order-name {
                flex-direction: column;
                justify-content: center;
            }
        }

        .btn {
            width: auto
        }
    </style>
    @yield('style')
</head>

<body>
    <!-- food section -->

    @yield('content')
    @yield('cart')


    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        <h4>
                            Contact Us
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Location
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call +01 1234567890
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    demo@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        <a href="" class="footer-logo">
                            Feane
                        </a>
                        <p>
                            Necessary, making this the first true generator on the Internet. It uses a dictionary of
                            over 200 Latin words, combined with
                        </p>
                        <div class="footer_social">
                            <a href="">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <h4>
                        Opening Hours
                    </h4>
                    <p>
                        Everyday
                    </p>
                    <p>
                        10.00 Am -10.00 Pm
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="public/assets_landingpage/js/jquery-3.4.1.min.js"></script> --}}
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    {{-- <script src="public/assets_landingpage/js/bootstrap.js"></script> --}}
    <script src="public/assets_landingpage/js/bootstrap.min.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="public/assets_landingpage/js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('script')
</body>

</html>
