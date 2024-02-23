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

    <title> Fishmarket Mandar </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="public/assets_landingpage/css/bootstrap.css" />

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

    <!-- Custom styles for this template -->
    <link href="public/assets_landingpage/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="public/assets_landingpage/css/responsive.css" rel="stylesheet" />

</head>

<body>

    <section class="about_section layout_padding">
        <div class="container  ">

            <div class="row">
                <div class="col-md-3 ">
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">

                            <div id="reader" width="300px"></div><br>
                            <h2>
                                Kembali ke Halaman Utama ?
                            </h2>
                        </div>
                        <input type="text" id="kode_produk_form">

                        <a href="{{ route('index') }}">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="col-md-3 ">
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- jQery -->
    <script src="public/assets_landingpage/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="public/assets_landingpage/js/bootstrap.js"></script>
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

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // document.getElementById('kode_produk_form').value = decodedText;
            if (decodedText) {
                fetch(`{{ route('index') }}/get_transaction/${decodedText}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Handle the received data
                        if (data && data.orderList && data.orderList.length > 0) {
                            // Save the fetched data to localStorage
                            localStorage.setItem('savedOrderList', JSON.stringify(data.orderList));
                            localStorage.setItem('statusCart', JSON.stringify(data.statusCart));
                            localStorage.setItem('kode_meja', decodedText);
                            console.log('Data saved to localStorage:', data.statusCart);
                            window.location.href = '{{ route('pilih_makanan') }}';
                        } else {
                            // If no data, set localStorage to an empty array
                            localStorage.setItem('savedOrderList', JSON.stringify([]));
                            console.log(data)
                            console.log('No data, localStorage set to an empty array');
                            window.location.href = '{{ route('pilih_makanan') }}';
                        }
                        // Access data using data.orderList and data.kodeMeja
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

</body>

</html>
